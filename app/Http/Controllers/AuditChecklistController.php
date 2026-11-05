<?php

namespace App\Http\Controllers;

use App\Models\AuditAssessment;
use App\Models\SmkpAudit;
use App\Models\SmkpElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditChecklistController extends Controller
{
    public function index(Request $request)
    {
        $auditId = $request->query('audit');

        // Jika checklist dibuka tanpa memilih audit, arahkan ke daftar audit.
        if (!$auditId) {
            return redirect()->route('audit.index');
        }

        // Pengguna hanya boleh membuka audit miliknya sendiri.
        $audit = SmkpAudit::with('site')
            ->where('auditor_id', auth()->id())
            ->findOrFail($auditId);

        $elements = SmkpElement::with([
            'criteria' => function ($query) {
                $query->orderBy('sort_order');
            },
            'criteria.indicators',
            'criteria.children.indicators',
            'criteria.children.children.indicators',
            'criteria.children.children.children.indicators',
            'criteria.children.children.children.children.indicators',
            'criteria.children.children.children.children.children.indicators',
        ])
            ->orderBy('sort_order')
            ->get();

        $savedAssessments = $audit->assessments()
            ->get()
            ->keyBy('smkp_criteria_id');

        return view('audit.checklist', compact(
            'elements',
            'audit',
            'savedAssessments'
        ));
    }

    public function save(Request $request, SmkpAudit $audit)
    {
        // Pastikan audit memang milik pengguna yang login.
        abort_unless(
            (int) $audit->auditor_id === (int) auth()->id(),
            403
        );

        if ($audit->status === 'completed') {
            return back()->withErrors([
                'audit' => 'Audit yang sudah selesai tidak dapat diubah.',
            ]);
        }

        $validated = $request->validate([
            'scores' => ['nullable', 'array'],
            'scores.*' => ['nullable'],
            'notes' => ['nullable', 'array'],
            'notes.*' => ['nullable', 'string', 'max:5000'],
        ]);

        $scores = $validated['scores'] ?? [];
        $notes = $validated['notes'] ?? [];

        // Ambil hanya kriteria yang benar-benar tersedia di database.
        $criteriaIds = array_unique(array_merge(
            array_map('intval', array_keys($scores)),
            array_map('intval', array_keys($notes))
        ));

        $criteriaList = \App\Models\SmkpCriteria::whereIn('id', $criteriaIds)
            ->get()
            ->keyBy('id');

        DB::transaction(function () use (
            $audit,
            $scores,
            $notes,
            $criteriaList
        ) {
            foreach ($criteriaList as $criteriaId => $criteria) {
                $rawScore = $scores[$criteriaId] ?? null;
                $note = $notes[$criteriaId] ?? null;

                // Dropdown kosong berarti belum dinilai.
                if ($rawScore === '') {
                    $rawScore = null;
                }

                $isNa = $rawScore === 'NA';

                if ($rawScore !== null && !$isNa) {
                    if (
                        !is_numeric($rawScore) ||
                        (int) $rawScore < 0 ||
                        (int) $rawScore > (int) ($criteria->max_score ?? 0)
                    ) {
                        abort(422, 'Nilai penilaian tidak sesuai dengan poin maksimal subelemen.');
                    }
                }

                AuditAssessment::updateOrCreate(
                    [
                        'smkp_audit_id' => $audit->id,
                        'smkp_criteria_id' => $criteriaId,
                    ],
                    [
                        'score' => $isNa || $rawScore === null
                            ? null
                            : (int) $rawScore,
                        'is_na' => $isNa,
                        'notes' => $note,
                    ]
                );
            }
        });

        return redirect()
            ->route('audit.checklist', ['audit' => $audit->id])
            ->with('success', 'Draft penilaian berhasil disimpan.');
    }



    public function complete(SmkpAudit $audit)
    {
        abort_unless(
            (int) $audit->auditor_id === (int) auth()->id(),
            403
        );

        if ($audit->status === 'completed') {
            return back()->with('success', 'Audit ini sudah selesai.');
        }

        $criteria = \App\Models\SmkpCriteria::whereDoesntHave('children')
            ->whereHas('indicators')
            ->whereNotNull('max_score')
            ->get();

        $assessments = $audit->assessments()
            ->get()
            ->keyBy('smkp_criteria_id');

        $incomplete = $criteria->filter(function ($item) use ($assessments) {
            $assessment = $assessments->get($item->id);

            return !$assessment ||
                (!$assessment->is_na && $assessment->score === null);
        });

        if ($criteria->isEmpty()) {
            return back()->withErrors([
                'audit' => 'Data subelemen penilaian belum tersedia.',
            ]);
        }

        if ($incomplete->isNotEmpty()) {
            return back()->withErrors([
                'audit' => 'Masih ada ' . $incomplete->count() .
                    ' subelemen yang belum dinilai. Lengkapi penilaian atau pilih N/A.',
            ]);
        }

        $audit->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        return redirect()
            ->route('audit.index')
            ->with('success', 'Audit berhasil diselesaikan.');
    }

    public function result(\App\Models\SmkpAudit $audit)
    {
        abort_unless(
            (int) $audit->auditor_id === (int) auth()->id(),
            403
        );

        abort_unless($audit->status === 'completed', 403);

        $assessments = $audit->assessments()
            ->with('criteria.element')
            ->get();

        $scoredAssessments = $assessments->filter(
            fn($item) => $item->score !== null || $item->is_na
        );

        $totalPoints = $scoredAssessments->sum(
            fn($item) => $item->is_na ? 0 : (int) $item->score
        );

        // Kurangi poin maksimal dari seluruh subelemen yang dipilih N/A.
        $naMaxPoints = $scoredAssessments
            ->filter(fn($item) => $item->is_na)
            ->sum(fn($item) => (int) ($item->criteria?->max_score ?? 0));

        $adjustedMaxPoints = max(0, 339 - $naMaxPoints);

        // Ambil elemen SMKP sesuai urutan database.
        $elements = \App\Models\SmkpElement::orderBy('sort_order')
            ->get();

        // Kelompokkan penilaian berdasarkan elemen SMKP.
        $elementResults = $elements->map(function ($element) use (
            $assessments,
            $scoredAssessments
        ) {
            $elementAssessments = $assessments
                ->filter(
                    fn($item) =>
                    $item->criteria?->smkp_element_id == $element->id
                );

            $elementScored = $scoredAssessments
                ->filter(
                    fn($item) =>
                    $item->criteria?->smkp_element_id == $element->id
                );

            // Nilai maksimal berdasarkan subelemen yang dapat dinilai.
            $maxPoints = \App\Models\SmkpCriteria::where(
                'smkp_element_id',
                $element->id
            )
                ->whereDoesntHave('children')
                ->whereHas('indicators')
                ->sum('max_score');

            // Kurangi poin maksimal subelemen N/A pada elemen ini.
            $elementNaMaxPoints = $elementScored
                ->filter(fn($item) => $item->is_na)
                ->sum(fn($item) => (int) ($item->criteria?->max_score ?? 0));

            $maxPoints = max(0, (int) $maxPoints - $elementNaMaxPoints);

            $points = $elementScored->sum(
                fn($item) => $item->is_na
                    ? 0
                    : (int) $item->score
            );

            $percentage = $maxPoints > 0
                ? round(($points / $maxPoints) * 100, 1)
                : 0;


            $weightPercentage = round(($maxPoints / 339) * 100, 1);

            $contributionPercentage = round(($points / 339) * 100, 1);

            return (object) [
                'element' => $element,
                'assessments' => $elementAssessments,
                'scored_count' => $elementScored->count(),
                'points' => $points,
                'max_points' => (int) $maxPoints,
                'percentage' => min(100, $percentage),
                'weight_percentage' => $weightPercentage,
                'contribution_percentage' => $contributionPercentage,
            ];
        });

        // Persentase keseluruhan berdasarkan patokan 339 poin.
        $overallPercentage = $adjustedMaxPoints > 0
            ? round(($totalPoints / $adjustedMaxPoints) * 100, 1)
            : 0;

        return view('audit.result', compact(
            'audit',
            'assessments',
            'scoredAssessments',
            'totalPoints',
            'adjustedMaxPoints',
            'elements',
            'elementResults',
            'overallPercentage'
        ));
    }

    public function revise(\App\Models\SmkpAudit $audit)
    {
        abort_unless(
            (int) $audit->auditor_id === (int) auth()->id(),
            403
        );

        if ($audit->status !== 'completed') {
            return redirect()
                ->route('audit.checklist', ['audit' => $audit->id])
                ->with('success', 'Audit sudah dalam status Draft.');
        }

        $audit->update([
            'status' => 'draft',
            'completed_at' => null,
        ]);

        return redirect()
            ->route('audit.checklist', ['audit' => $audit->id])
            ->with(
                'success',
                'Mode revisi aktif. Perbaiki penilaian, lalu selesaikan audit kembali.'
            );
    }
}

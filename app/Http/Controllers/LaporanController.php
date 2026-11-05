<?php

namespace App\Http\Controllers;

use App\Models\SmkpAudit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    /**
     * Daftar audit yang sudah selesai.
     */
    public function index()
    {
        $query = SmkpAudit::with('site', 'auditor')
            ->where('status', 'completed');

        // Admin dapat melihat seluruh audit.
        // Auditor hanya dapat melihat audit miliknya.
        if (Auth::user()->role !== 'admin') {
            $query->where('auditor_id', Auth::id());
        }

        $audits = $query
            ->orderByDesc('audit_date')
            ->orderByDesc('id')
            ->get();

        return view('laporan.index', compact('audits'));
    }


    public function cetakKesesuaianPdf(SmkpAudit $audit)
    {
        abort_unless($audit->status === 'completed', 404);

        if (Auth::user()->role !== 'admin') {
            abort_unless(
                (int) $audit->auditor_id === (int) Auth::id(),
                403
            );
        }

        $audit->load('site', 'auditor');

        // Ambil seluruh hasil penilaian, termasuk N/A dan skor 0.
        $assessments = $audit->assessments()
            ->with('criteria.element')
            ->get()
            ->sortBy(function ($assessment) {
                return sprintf(
                    '%05d-%s-%05d',
                    $assessment->criteria?->element?->sort_order ?? 99999,
                    $assessment->criteria?->code ?? '',
                    $assessment->criteria?->sort_order ?? 99999
                );
            })
            ->values();

        // Penilaian yang sudah memiliki skor atau dipilih N/A.
        $scoredAssessments = $assessments->filter(
            fn($item) => $item->score !== null || $item->is_na
        );

        // Perhitungan total mengikuti AuditChecklistController.
        $totalPoints = $scoredAssessments->sum(
            fn($item) => $item->is_na ? 0 : (int) $item->score
        );

        $naMaxPoints = $scoredAssessments
            ->filter(fn($item) => $item->is_na)
            ->sum(fn($item) => (int) ($item->criteria?->max_score ?? 0));

        $adjustedMaxPoints = max(0, 339 - $naMaxPoints);

        $overallPercentage = $adjustedMaxPoints > 0
            ? round(($totalPoints / $adjustedMaxPoints) * 100, 1)
            : 0;

        $overallPercentage = round(($totalPoints / 339) * 100, 1);

        // Bobot tetap setiap elemen SMKP.
        $weights = [10, 15, 17, 35, 15, 3, 5];

        $elements = \App\Models\SmkpElement::orderBy('sort_order')
            ->get();

        // Susun hasil per elemen.
        $elementResults = $elements->values()->map(
            function ($element, $index) use (
                $assessments,
                $scoredAssessments,
                $weights
            ) {
                $elementAssessments = $assessments
                    ->filter(
                        fn($item) =>
                        $item->criteria?->smkp_element_id == $element->id
                    )
                    ->values();

                $elementScored = $scoredAssessments
                    ->filter(
                        fn($item) =>
                        $item->criteria?->smkp_element_id == $element->id
                    );

                $maxPoints = \App\Models\SmkpCriteria::where(
                    'smkp_element_id',
                    $element->id
                )
                    ->whereDoesntHave('children')
                    ->whereHas('indicators')
                    ->sum('max_score');

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

                $weight = $weights[$index] ?? 0;

                $weightedValue = $maxPoints > 0
                    ? ($points / $maxPoints) * $weight
                    : 0;

                $weightedValue = min($weight, $weightedValue);

                return (object) [
                    'element' => $element,
                    'assessments' => $elementAssessments,
                    'scored_count' => $elementScored->count(),
                    'points' => $points,
                    'max_points' => (int) $maxPoints,
                    'percentage' => min(100, $percentage),
                    'weight' => $weight,
                    'weighted_value' => $weightedValue,
                ];
            }
        );

        $pdf = Pdf::loadView(
            'laporan.kesesuaian-pdf',
            compact(
                'audit',
                'assessments',
                'scoredAssessments',
                'totalPoints',
                'adjustedMaxPoints',
                'overallPercentage',
                'elementResults'
            )
        )->setPaper('a4', 'landscape');

        $filename = 'Laporan_Kesesuaian_Audit_' .
            $audit->id . '.pdf';

        return $pdf->download($filename);
    }
}

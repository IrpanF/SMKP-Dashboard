<?php

namespace App\Http\Controllers;

use App\Models\SmkpAudit;
use App\Models\SmkpCriteria;
use App\Models\SmkpElement;
use App\Models\Finding;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        // Audit milik pengguna yang sedang login.
        $audits = SmkpAudit::where('auditor_id', $userId)
            ->orderByDesc('created_at')
            ->get();

        $totalAudits = $audits->count();
        // ID audit yang dapat diakses pengguna saat ini.
        $auditIds = $audits->pluck('id');

        // Total seluruh temuan dari audit tersebut.
        $totalFindings = Finding::whereIn('smkp_audit_id', $auditIds)
            ->count();

        // Temuan yang belum diverifikasi.
        $openFindings = Finding::whereIn('smkp_audit_id', $auditIds)
            ->whereNull('verified_date')
            ->count();

        $completedAudits = $audits
            ->where('status', 'completed')
            ->count();

        // Audit selesai terbaru.
        // Daftar audit selesai yang dapat dipilih.
        $availableAudits = SmkpAudit::where('auditor_id', $userId)
            ->where('status', 'completed')
            ->orderByDesc('completed_at')
            ->orderByDesc('created_at')
            ->get();

        // Query audit selesai milik pengguna.
        $completedAuditQuery = SmkpAudit::with('assessments.criteria.element')
            ->where('auditor_id', $userId)
            ->where('status', 'completed');

        // Jika pengguna memilih audit tertentu, tampilkan audit tersebut.
        $dashboardAudit = null;

        if ($request->filled('audit_id')) {
            $dashboardAudit = (clone $completedAuditQuery)
                ->whereKey($request->input('audit_id'))
                ->first();
        }

        // Jika belum memilih atau pilihan tidak valid,
        // tampilkan audit selesai terbaru.
        if (!$dashboardAudit) {
            $dashboardAudit = (clone $completedAuditQuery)
                ->orderByDesc('completed_at')
                ->orderByDesc('created_at')
                ->first();
        }

        $elementResults = collect();
        $overallPercentage = 0;
        $totalPoints = 0;

        if ($dashboardAudit) {
            $assessments = $dashboardAudit->assessments;

            $scoredAssessments = $assessments->filter(
                fn($item) => $item->score !== null || $item->is_na
            );

            $totalPoints = $scoredAssessments->sum(
                fn($item) => $item->is_na ? 0 : (int) $item->score
            );

            $elements = SmkpElement::orderBy('sort_order')->get();

            $elementWeights = [10, 15, 17, 35, 15, 3, 5];

            $elementResults = $elements->values()->map(
                function ($element, $index) use (
                    $assessments,
                    $scoredAssessments,
                    $elementWeights
                ) {
                    $elementAssessments = $assessments->filter(
                        fn($item) => $item->criteria?->smkp_element_id == $element->id
                    );

                    $elementScored = $scoredAssessments->filter(
                        fn($item) => $item->criteria?->smkp_element_id == $element->id
                    );

                    $maxPoints = SmkpCriteria::where(
                        'smkp_element_id',
                        $element->id
                    )
                        ->whereDoesntHave('children')
                        ->whereHas('indicators')
                        ->sum('max_score');

                    $points = $elementScored->sum(
                        fn($item) => $item->is_na ? 0 : (int) $item->score
                    );

                    $weight = $elementWeights[$index] ?? 0;

                    $percentage = $maxPoints > 0
                        ? ($points / $maxPoints) * 100
                        : 0;

                    $contribution = $maxPoints > 0
                        ? ($points / $maxPoints) * $weight
                        : 0;

                    return (object) [
                        'element' => $element,
                        'points' => $points,
                        'max_points' => (int) $maxPoints,
                        'percentage' => round($percentage, 2),
                        'weight_percentage' => $weight,
                        'contribution_percentage' => round($contribution, 2),
                        'scored_count' => $elementScored->count(),
                        'assessment_count' => $elementAssessments->count(),
                    ];
                }
            );

            // Pertahankan rumus nilai keseluruhan yang saat ini digunakan.
            $overallPercentage = round(($totalPoints / 339) * 100, 1);
        }

        // Jumlah audit per bulan pada tahun berjalan.
        $monthlyAudits = array_fill(1, 12, 0);

        foreach ($audits as $auditItem) {
            if (
                $auditItem->created_at &&
                $auditItem->created_at->year === now()->year
            ) {
                $month = (int) $auditItem->created_at->format('n');
                $monthlyAudits[$month]++;
            }
        }

        return view('dashboard', compact(
            'audits',
            'totalAudits',
            'completedAudits',
            'totalFindings',
            'openFindings',
            'availableAudits',
            'dashboardAudit',
            'elementResults',
            'totalPoints',
            'overallPercentage',
            'monthlyAudits'
        ));
    }
}

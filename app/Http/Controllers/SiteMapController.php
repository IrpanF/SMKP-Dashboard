<?php

namespace App\Http\Controllers;

use App\Models\Finding;

class SiteMapController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $query = Finding::query()->with('audit:id,title,auditor_id');

        // Auditor hanya melihat temuan dari audit miliknya.
        // Admin dapat melihat seluruh temuan.
        if ($user->role === 'auditor') {
            $query->whereHas('audit', function ($auditQuery) use ($user) {
                $auditQuery->where('auditor_id', $user->id);
            });
        } elseif ($user->role !== 'admin') {
            abort(403, 'Kamu tidak memiliki akses ke peta site.');
        }

        $findings = $query->get([
            'id',
            'location_name',
            'status',
            'smkp_audit_id',
        ]);

        /*
         * Koordinat di bawah hanya titik perkiraan untuk tampilan awal,
         * bukan koordinat resmi lokasi operasional.
         * Konfirmasikan dengan data perusahaan sebelum digunakan secara resmi.
         */
        $sites = [
            [
                'name' => 'Site Tuban',
                'keyword' => 'tuban',
                'lat' => -6.88467,
                'lng' => 112.01377,
                'coordinate_note' => 'Perkiraan awal; perlu konfirmasi',
            ],
            [
                'name' => 'Site Rembang',
                'keyword' => 'rembang',
                'lat' => -6.711,
                'lng' => 111.345,
                'coordinate_note' => 'Perkiraan pusat wilayah; perlu konfirmasi',
            ],
            [
                'name' => 'Site Padang',
                'keyword' => 'padang',
                'lat' => -0.947,
                'lng' => 100.417,
                'coordinate_note' => 'Perkiraan pusat wilayah; perlu konfirmasi',
            ],
            [
                'name' => 'Site Tonasa',
                'keyword' => 'tonasa',
                'lat' => -4.85,
                'lng' => 119.78,
                'coordinate_note' => 'Koordinat perkiraan area Tonasa; perlu konfirmasi',
            ],
            [
                'name' => 'Site Lamongan',
                'keyword' => 'lamongan',
                'lat' => -7.116,
                'lng' => 112.416,
                'coordinate_note' => 'Perkiraan pusat wilayah; perlu konfirmasi',
            ],
        ];

        $statusLabels = [
            'open' => 'Terbuka',
            'in_progress' => 'Dalam Proses',
            'revision_required' => 'Perlu Revisi',
            'pending_verification' => 'Menunggu Verifikasi',
            'completed' => 'Selesai',
        ];

        $siteData = collect($sites)->map(function ($site) use (
            $findings,
            $statusLabels
        ) {
            $siteFindings = $findings->filter(function ($finding) use ($site) {
                return str_contains(
                    mb_strtolower($finding->location_name ?? ''),
                    $site['keyword']
                );
            });

            $counts = [];

            foreach ($statusLabels as $status => $label) {
                $counts[$status] = $siteFindings
                    ->where('status', $status)
                    ->count();
            }

            return array_merge($site, [
                'total' => $siteFindings->count(),
                'counts' => $counts,
            ]);
        })->values();

        $overallCounts = [];

        foreach ($statusLabels as $status => $label) {
            $overallCounts[$status] = $findings
                ->where('status', $status)
                ->count();
        }

        return view('sites.map', [
            'sites' => $siteData,
            'statusLabels' => $statusLabels,
            'overallCounts' => $overallCounts,
            'totalFindings' => $findings->count(),
        ]);
    }
}

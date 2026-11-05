<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekapitulasi Ketidaksesuaian Eksternal</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 20px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #111827;
        }

        .header {
            text-align: center;
            margin-bottom: 18px;
        }

        .header h2 {
            font-size: 15px;
            margin: 0 0 8px;
            font-weight: bold;
        }

        .site {
            font-size: 12px;
            font-weight: bold;
            margin: 0;
        }

        .date {
            margin-top: 18px;
            margin-bottom: 10px;
            text-align: left;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #111827;
            padding: 7px 5px;
            vertical-align: top;
            overflow-wrap: break-word;
        }

        th {
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
            background: #f1f5f9;
        }

        td.center {
            text-align: center;
            vertical-align: middle;
        }

        .col-no { width: 5%; }
        .col-number { width: 17%; }
        .col-description { width: 35%; }
        .col-category { width: 12%; }
        .col-deadline { width: 17%; }
        .col-status { width: 14%; }

        .empty {
            text-align: center;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>FORMULIR REKAPITULASI KETIDAKSESUAIAN</h2>
        <p class="site">PT United Tractors Semen Gresik - Site: {{ $selectedSite }}</p>
    </div>

    <div class="date">
        <strong>
            Tanggal Audit: {{ \Carbon\Carbon::parse($reportDate)->format('d-m-Y') }}
        </strong>
    </div>

    <table>
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-number">Nomor Ketidaksesuaian</th>
                <th class="col-description">Deskripsi Ketidaksesuaian</th>
                <th class="col-category">Kategori</th>
                <th class="col-deadline">Batas Waktu Perbaikan</th>
                <th class="col-status">Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($findings as $finding)
                @php
                    $statusLabels = [
                        'open' => 'Terbuka',
                        'in_progress' => 'Dalam Proses',
                        'pending_verification' => 'Menunggu Verifikasi',
                        'revision_required' => 'Perlu Revisi',
                        'completed' => 'Selesai',
                        'closed' => 'Ditutup',
                        'rejected' => 'Ditolak',
                    ];

                    $deadline = $finding->audit_date && $finding->action_days !== null
                        ? $finding->audit_date->copy()->addDays($finding->action_days)
                        : null;
                @endphp

                <tr>
                    <td class="center">{{ $loop->iteration }}</td>

                    <td>
                        {{ $finding->finding_no ?: '-' }}
                    </td>

                    <td>
                        {{ $finding->problem ?: '-' }}
                    </td>

                    <td class="center">
                        {{ ucfirst(str_replace('_', ' ', $finding->finding_category ?? '-')) }}
                    </td>

                    <td class="center">
                        {{ $deadline ? $deadline->format('d-m-Y') : '-' }}
                    </td>

                    <td class="center">
                        {{ $statusLabels[$finding->status ?? ''] ?? ucfirst(str_replace('_', ' ', $finding->status ?? 'Belum ditentukan')) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty">
                        Tidak ada data ketidaksesuaian.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

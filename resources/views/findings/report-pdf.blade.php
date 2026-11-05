<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Temuan Ketidaksesuaian</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 12px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 7px;
            color: #222;
        }

        h2 {
            text-align: center;
            font-size: 13px;
            margin: 0 0 5px;
            text-transform: uppercase;
        }

        .subtitle {
            text-align: center;
            font-size: 9px;
            margin-bottom: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #555;
            padding: 4px 3px;
            vertical-align: top;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        th {
            background-color: #dfe8e2;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f7f9f8;
        }

        .center {
            text-align: center;
        }

        .problem {
            width: 12%;
        }

        .eviden {
            width: 8%;
        }

        .reference {
            width: 7%;
        }

        .action {
            width: 9%;
        }

        .responsible {
            width: 6%;
        }

        .small {
            font-size: 6px;
        }

        //evidence
        .evidence-item {
            margin-bottom: 8px;
            padding-bottom: 6px;
            border-bottom: 1px solid #ddd;
            page-break-inside: avoid;
        }

        .evidence-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .evidence-caption {
            font-size: 7px;
            font-weight: normal;
            line-height: 1.4;
            margin-bottom: 4px;
            overflow-wrap: break-word;
        }

        .evidence-image {
            display: block;
            max-width: 100%;
            max-height: 110px;
            width: auto;
            height: auto;
            margin: 0 auto;
            object-fit: contain;
        }

        .evidence-filename {
            font-size: 6px;
            overflow-wrap: break-word;
        }
    </style>
</head>

<body>

    <h2>Temuan Ketidaksesuaian</h2>

    <div class="subtitle">
        <strong>
            Laporan Hasil Audit Sistem Manajemen Keselamatan Pertambangan
            <br>
            PT United Tractors Semen Gresik - Site: {{ $selectedSite }}
        </strong>
    </div>

    <div style="text-align: left; font-size: 8px; margin-bottom: 8px;">
        <strong>
            Tanggal Laporan: {{ \Carbon\Carbon::parse($reportDate)->format('d-m-Y') }}
        </strong>
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Kategori</th>
                <th rowspan="2" class="problem">
                    Masalah / Bahaya / Penyimpangan
                </th>
                <th rowspan="2" class="eviden">
                    Bukti
                </th>
                <th colspan="2">Referensi</th>
                <th rowspan="2">Deskripsi</th>
                <th rowspan="2">Status</th>
                <th rowspan="2">Akar Permasalahan</th>
                <th rowspan="2">Tindakan Perbaikan dan Pencegahan</th>
                <th colspan="2">Penanggung Jawab</th>
                <th rowspan="2">Batas Waktu Perbaikan</th>
                <th rowspan="2">Bukti / Eviden</th>
                <th rowspan="2">Periode Temuan</th>
                <th rowspan="2">Status RTL</th>
            </tr>
            <tr>
                <th class="reference">Elemen</th>
                <th class="reference">Sub Elemen</th>
                <th class="responsible">Fungsi</th>
                <th class="responsible">PIC</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($findings as $index => $finding)
                @php
                    $matrixText = trim((string) $finding->matriks);
                    $matrixLines = preg_split('/\r\n|\r|\n/', $matrixText);

                    $matrixElements = [];
                    $matrixSubElements = [];

                    foreach ($matrixLines as $line) {
                        $line = trim($line);

                        if ($line === '') {
                            continue;
                        }

                        if (preg_match('/^[-•]\s*(.+)$/u', $line, $matches)) {
                            $matrixSubElements[] = trim($matches[1]);
                        } else {
                            $matrixElements[] = $line;
                        }
                    }

                    $evidenceFiles = $finding->evidence_files ?? [];
                    $evidenceCaptions = $finding->evidence_captions ?? [];
                    $rtlFiles = $finding->rtl_files ?? [];
                    $rtlCaptions = $finding->rtl_file_captions ?? [];

                    if (is_string($evidenceFiles)) {
                        $evidenceFiles = json_decode($evidenceFiles, true) ?: [];
                    }

                    if (is_string($evidenceCaptions)) {
                        $evidenceCaptions = json_decode($evidenceCaptions, true) ?: [];
                    }

                    if (is_string($rtlFiles)) {
                        $rtlFiles = json_decode($rtlFiles, true) ?: [];
                    }

                    if (is_string($rtlCaptions)) {
                        $rtlCaptions = json_decode($rtlCaptions, true) ?: [];
                    }

                    $evidenceFiles = is_array($evidenceFiles) ? array_values($evidenceFiles) : [];
                    $evidenceCaptions = is_array($evidenceCaptions) ? array_values($evidenceCaptions) : [];
                    $rtlFiles = is_array($rtlFiles) ? array_values($rtlFiles) : [];
                    $rtlCaptions = is_array($rtlCaptions) ? array_values($rtlCaptions) : [];

                    $statusLabels = [
                        'open' => 'Terbuka',
                        'in_progress' => 'Dalam Proses',
                        'pending_verification' => 'Menunggu Verifikasi',
                        'revision_required' => 'Perlu Revisi',
                        'completed' => 'Selesai',
                        'closed' => 'Ditutup',
                        'rejected' => 'Ditolak',
                    ];
                @endphp

                <tr>
                    {{-- 1. No --}}
                    <td class="center">{{ $index + 1 }}</td>

                    {{-- 2. Kategori --}}
                    <td>{{ $finding->finding_category ?: '-' }}</td>

                    {{-- 3. Masalah / Bahaya / Penyimpangan --}}
                    <td>{{ $finding->problem ?: '-' }}</td>

                    {{-- 4. Bukti / Objective Evidence --}}
                    <td>
                        @if (count($evidenceCaptions) || count($evidenceFiles))
                            @foreach (array_unique(array_merge(array_keys($evidenceCaptions), array_keys($evidenceFiles))) as $fileIndex)
                                @php
                                    $caption = trim((string) ($evidenceCaptions[$fileIndex] ?? ''));
                                    $file = $evidenceFiles[$fileIndex] ?? null;
                                @endphp

                                @if ($caption !== '' || !empty($file))
                                    <div class="evidence-item">
                                        @if ($caption !== '')
                                            <div class="evidence-caption">
                                                {{ $caption }}
                                            </div>
                                        @endif

                                        @if (!empty($file))
                                            @php
                                                $imagePath = public_path('storage/' . $file);
                                                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                            @endphp

                                            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp']) && file_exists($imagePath))
                                                <img src="{{ $imagePath }}" class="evidence-image">
                                            @else
                                                <div class="evidence-filename">
                                                    Lampiran: {{ basename($file) }}
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <span>-</span>
                        @endif
                    </td>

                    {{-- 5. Referensi: Elemen --}}
                    <td>
                        @forelse ($matrixElements as $element)
                            <div>{{ $element }}</div>
                        @empty
                            -
                        @endforelse
                    </td>

                    {{-- 6. Referensi: Sub Elemen --}}
                    <td>
                        @forelse ($matrixSubElements as $subElement)
                            <div>{{ $subElement }}</div>
                        @empty
                            -
                        @endforelse
                    </td>

                    {{-- 7. Deskripsi --}}
                    <td>{{ $finding->recommendation ?: '-' }}</td>

                    {{-- 8. Status --}}
                    <td>
                        {{ $statusLabels[$finding->status] ?? ($finding->status ?: '-') }}
                    </td>

                    {{-- 9. Akar Permasalahan --}}
                    <td>{{ $finding->root_cause ?: '-' }}</td>

                    {{-- 10. Tindakan Perbaikan dan Pencegahan --}}
                    <td>{{ $finding->rtl_response ?: '-' }}</td>

                    {{-- 11. Fungsi --}}
                    <td>{{ $finding->function_name ?: '-' }}</td>

                    {{-- 12. PIC --}}
                    <td>{{ $finding->auditee ?: '-' }}</td>

                    {{-- 13. Batas Waktu Perbaikan --}}
                    <td>
                        @if ($finding->audit_date && $finding->action_days)
                            {{ $finding->audit_date->copy()->addDays($finding->action_days)->format('d-m-Y') }}
                        @else
                            -
                        @endif
                    </td>


                    {{-- 14. Bukti / Eviden RTL --}}
                    <td>
                        @forelse ($rtlFiles as $fileIndex => $file)
                            @php
                                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'webp']);

                                $caption = $rtlCaptions[$fileIndex] ?? '';
                                $caption =
                                    is_string($caption) && trim($caption) !== ''
                                        ? trim($caption)
                                        : 'Bukti perbaikan ' . ($fileIndex + 1);

                                /*
                                 * Untuk DomPDF, gunakan path file lokal.
                                 * Pastikan file berada di storage/app/public.
                                 */
                                $imagePath = public_path('storage/' . $file);
                                $imageExists = $isImage && file_exists($imagePath);
                            @endphp

                            <div class="evidence-item">
                                <div class="evidence-caption">
                                    {{ $caption }}
                                </div>

                                @if ($imageExists)
                                    <img src="{{ $imagePath }}" alt="{{ $caption }}" class="evidence-image">
                                @elseif ($isImage)
                                    <div class="evidence-filename">
                                        Gambar tidak ditemukan: {{ basename($file) }}
                                    </div>
                                @else
                                    <div class="evidence-filename">
                                        [{{ strtoupper($extension ?: 'FILE') }}]
                                        {{ basename($file) }}
                                    </div>
                                @endif
                            </div>
                        @empty
                            -
                        @endforelse
                    </td>

                    {{-- 15. Periode Temuan --}}
                    <td>
                        {{ $finding->audit_date ? $finding->audit_date->format('d-m-Y') : '-' }}
                    </td>

                    {{-- 16. Status RTL --}}
                    <td>
                        {{ $statusLabels[$finding->status] ?? ($finding->status ?: '-') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="17" class="center">
                        Belum ada data temuan ketidaksesuaian.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <style>
        @page {
            size: A4 landscape;
            margin: 22px 25px 35px 25px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            color: #1e293b;
            line-height: 1.4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .header {
            border-bottom: 2px solid #047857;
            padding-bottom: 10px;
            margin-bottom: 12px;
        }

        .header-title {
            font-size: 15px;
            font-weight: bold;
            color: #065f46;
            text-align: center;
        }

        .header-subtitle {
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            margin-top: 4px;
        }

        .audit-info {
            margin-bottom: 12px;
        }

        .audit-info td {
            padding: 3px 5px;
            vertical-align: top;
        }

        .label {
            width: 115px;
            font-weight: bold;
            color: #475569;
        }

        .section-title {
            font-size: 11px;
            font-weight: bold;
            color: #065f46;
            margin: 12px 0 6px;
        }

        .summary {
            margin-bottom: 12px;
        }

        .summary td {
            border: 1px solid #cbd5e1;
            padding: 7px;
            text-align: center;
        }

        .summary-label {
            background: #f1f5f9;
            font-weight: bold;
            color: #475569;
        }

        .summary-value {
            font-size: 13px;
            font-weight: bold;
            color: #065f46;
        }

        .result-table {
            table-layout: fixed;
        }

        .result-table th {
            background: #047857;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 7px 5px;
            border: 1px solid #047857;
        }

        .result-table td {
            border: 1px solid #cbd5e1;
            padding: 6px 5px;
            vertical-align: top;
        }

        .element-row td {
            background: #ecfdf5;
            font-weight: bold;
            color: #065f46;
            padding: 8px 6px;
        }

        .element-summary {
            font-size: 8px;
            color: #334155;
            font-weight: normal;
        }

        .center {
            text-align: center;
        }

        .muted {
            color: #64748b;
        }

        .best {
            color: #047857;
            font-weight: bold;
        }

        .minor {
            color: #b45309;
            font-weight: bold;
        }

        .major {
            color: #b91c1c;
            font-weight: bold;
        }

        .na {
            color: #64748b;
            font-weight: bold;
        }

        .total-row td {
            background: #f1f5f9;
            font-weight: bold;
            padding: 9px 6px;
            border: 1px solid #94a3b8;
        }

        .notes {
            white-space: normal;
            word-wrap: break-word;
        }

        .footer {
            margin-top: 20px;
            page-break-inside: avoid;
        }

        .signature {
            width: 100%;
            margin-top: 12px;
        }

        .signature td {
            text-align: center;
            width: 50%;
            padding: 5px;
        }

        .signature-space {
            height: 55px;
        }

        .page-number {
            position: fixed;
            bottom: -22px;
            left: 0;
            right: 0;
            text-align: right;
            font-size: 8px;
            color: #64748b;
        }

        .page-number:after {
            content: "Halaman " counter(page) " dari " counter(pages);
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <div class="header-title">
            LAPORAN HASIL AUDIT
        </div>

        <div class="header-subtitle">
            SISTEM MANAJEMEN KESELAMATAN PERTAMBANGAN
        </div>
    </div>

    {{-- INFORMASI AUDIT --}}
    <table class="audit-info">
        <tr>
            <td class="label">Judul Audit</td>
            <td>: {{ $audit->title }}</td>

            <td class="label">Auditor</td>
            <td>: {{ $audit->auditor?->name ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Perusahaan / Site</td>
            <td>
                : {{ $audit->site
                    ? $audit->site->company_name . ' - Site ' . $audit->site->site_name
                    : '-' }}
            </td>

            <td class="label">Tanggal Mulai</td>
            <td>: {{ $audit->audit_start_date?->format('d/m/Y') ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Periode Audit</td>
            <td>
                : {{ $audit->audit_start_date?->format('d/m/Y') ?? '-' }}
                s.d.
                {{ $audit->audit_end_date?->format('d/m/Y') ?? '-' }}
            </td>

            <td class="label">Tanggal Selesai</td>
            <td>: {{ $audit->completed_at?->format('d/m/Y') ?? '-' }}</td>
        </tr>
    </table>

    {{-- RINGKASAN --}}
    <div class="section-title">RINGKASAN HASIL AUDIT</div>

    <table class="summary">
        <tr>
            <td class="summary-label">Total Poin</td>
            <td class="summary-label">Persentase Capaian</td>
            <td class="summary-label">Subelemen Dinilai</td>
            <td class="summary-label">Jumlah Elemen</td>
        </tr>

        <tr>
            <td class="summary-value">
                {{ $totalPoints }} / {{ $adjustedMaxPoints }}
            </td>

            <td class="summary-value">
                {{ number_format($overallPercentage, 1, ',', '.') }}%
            </td>

            <td class="summary-value">
                {{ $scoredAssessments->count() }}
            </td>

            <td class="summary-value">
                {{ $elementResults->count() }}
            </td>
        </tr>
    </table>

    {{-- RINCIAN PENILAIAN --}}
    <div class="section-title">
        RINCIAN HASIL PENILAIAN PER ELEMEN SMKP
    </div>

    <table class="result-table">
        <thead>
            <tr>
                <th style="width: 4%;">No.</th>
                <th style="width: 10%;">Kode</th>
                <th style="width: 36%;">Subelemen / Kriteria</th>
                <th style="width: 9%;">Nilai</th>
                <th style="width: 14%;">Hasil</th>
                <th style="width: 27%;">Catatan Auditor</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($elementResults as $result)
                {{-- BARIS ELEMEN --}}
                <tr class="element-row">
                    <td colspan="6">
                        ELEMEN {{ $loop->iteration }}:
                        {{ $result->element->name }}

                        <span class="element-summary">
                            &nbsp; | &nbsp;
                            Poin: {{ $result->points }}/{{ $result->max_points }}
                            &nbsp; | &nbsp;
                            Capaian: {{ number_format($result->percentage, 1, ',', '.') }}%
                            &nbsp; | &nbsp;
                            Bobot: {{ $result->weight }}%
                            &nbsp; | &nbsp;
                            Nilai berbobot:
                            {{ number_format($result->weighted_value, 2, ',', '.') }}%
                        </span>
                    </td>
                </tr>

                {{-- BARIS SUBELEMEN --}}
                @forelse ($result->assessments as $assessment)
                    @php
                        $skor = $assessment->score !== null
                            ? (int) $assessment->score
                            : null;

                        $skorMaksimal = $assessment->criteria?->max_score !== null
                            ? (int) $assessment->criteria->max_score
                            : null;

                        if ($assessment->is_na) {
                            $hasil = 'N/A';
                            $classHasil = 'na';
                        } elseif ($skor === null || $skorMaksimal === null) {
                            $hasil = 'Belum dinilai';
                            $classHasil = 'na';
                        } elseif ($skor === $skorMaksimal) {
                            $hasil = 'Praktik Terbaik';
                            $classHasil = 'best';
                        } elseif (
                            ($skorMaksimal === 4 && $skor >= 2 && $skor <= 3) ||
                            ($skorMaksimal === 3 && $skor === 2)
                        ) {
                            $hasil = 'Minor';
                            $classHasil = 'minor';
                        } elseif (
                            ($skorMaksimal === 4 && $skor <= 1) ||
                            ($skorMaksimal === 3 && $skor <= 1) ||
                            ($skorMaksimal === 2 && $skor < 2) ||
                            ($skorMaksimal === 1 && $skor === 0)
                        ) {
                            $hasil = 'Mayor';
                            $classHasil = 'major';
                        } else {
                            $hasil = 'Belum ditentukan';
                            $classHasil = 'na';
                        }
                    @endphp

                    <tr>
                        <td class="center">
                            {{ $loop->iteration }}
                        </td>

                        <td class="center">
                            {{ $assessment->criteria?->code ?? '-' }}
                        </td>

                        <td>
                            {{ $assessment->criteria?->name ?? 'Kriteria tidak tersedia' }}
                        </td>

                        <td class="center">
                            @if ($assessment->is_na)
                                N/A
                            @elseif ($skor !== null)
                                {{ $skor }} / {{ $skorMaksimal ?? '-' }}
                            @else
                                -
                            @endif
                        </td>

                        <td class="center {{ $classHasil }}">
                            {{ $hasil }}
                        </td>

                        <td class="notes">
                            {{ $assessment->notes ?: '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="center muted">
                            Belum ada rincian penilaian.
                        </td>
                    </tr>
                @endforelse
            @endforeach

            {{-- TOTAL --}}
            <tr class="total-row">
                <td colspan="3" class="center">
                    TOTAL HASIL PENILAIAN
                </td>

                <td class="center">
                    {{ $totalPoints }} / {{ $adjustedMaxPoints }}
                </td>

                <td class="center">
                    {{ number_format($overallPercentage, 1, ',', '.') }}%
                </td>

                <td>
                    Persentase keseluruhan berdasarkan patokan {{ $adjustedMaxPoints }} poin.
                </td>
            </tr>
        </tbody>
    </table>

    {{-- TANDA TANGAN --}}
    <div class="footer">
        <table class="signature">
            <tr>
                <td>
                    Auditor,
                </td>
                <td>
                    Mengetahui,
                </td>
            </tr>

            <tr>
                <td class="signature-space"></td>
                <td class="signature-space"></td>
            </tr>

            <tr>
                <td>
                    <strong>
                        {{ $audit->auditor?->name ?? '(................................)' }}
                    </strong>
                </td>

                <td>
                    <strong>
                        (........................................)
                    </strong>
                </td>
            </tr>
        </table>
    </div>

    <div class="page-number"></div>

</body>
</html>

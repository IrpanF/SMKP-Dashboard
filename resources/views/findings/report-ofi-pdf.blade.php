<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Formulir Rekomendasi dan Peluang untuk Perbaikan</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 14mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #111;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            font-size: 15px;
            margin: 0 0 8px;
            font-weight: bold;
        }

        .header h3 {
            font-size: 12px;
            margin: 0;
            font-weight: bold;
        }

        .identity {
            margin-bottom: 12px;
            line-height: 1.8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #222;
            padding: 8px;
            vertical-align: top;
            overflow-wrap: break-word;
        }

        th {
            text-align: center;
            font-weight: bold;
            background: #f1f1f1;
        }

        .element {
            width: 20%;
        }

        .sub-element {
            width: 25%;
        }

        .recommendation {
            width: 55%;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>FORMULIR REKOMENDASI DAN PELUANG UNTUK PERBAIKAN</h2>
        <h3>
            PENERAPAN SISTEM MANAJEMEN KESELAMATAN PERTAMBANGAN (*)
        </h3>
    </div>

    <div class="identity">
        <strong>PT UNITED TRACTORS SEMEN GRESIK Site {{ $selectedSite }}</strong>
        <br>
        <strong>Tanggal Audit:</strong>
        {{ \Carbon\Carbon::parse($reportDate)->format('d-m-Y') }}
    </div>

    <table>
        <thead>
            <tr>
                <th class="element">Elemen</th>
                <th class="sub-element">Sub Elemen</th>
                <th class="recommendation">
                    Rekomendasi dan Peluang untuk Perbaikan
                </th>
            </tr>
        </thead>


        <tbody>
            @foreach ($findings as $finding)
                @php
                    $matrixLines = preg_split('/\r\n|\r|\n/', trim($finding->matriks ?? ''));

                    $matrixLines = array_values(
                        array_filter(array_map('trim', $matrixLines), fn($line) => $line !== ''),
                    );

                    // Baris pertama adalah nama elemen.
                    $elementName = $matrixLines[0] ?? '-';

                    // Baris berikutnya adalah daftar subelemen.
                    $subElements = array_slice($matrixLines, 1);

                    $subElements = array_map(function ($line) {
                        return preg_replace('/^\s*-\s*/', '', $line);
                    }, $subElements);
                @endphp

                <tr>
                    <td>
                        {{ $elementName }}
                    </td>

                    <td>
                        @if (count($subElements))
                            {!! nl2br(e(implode("\n", $subElements))) !!}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        {{ $finding->recommendation ?: '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</body>

</html>

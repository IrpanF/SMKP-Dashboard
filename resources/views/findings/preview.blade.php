<x-app-layout>
    <div class="min-h-screen bg-slate-100 px-4 py-8">
        <div class="mx-auto max-w-5xl">

            {{-- Tombol navigasi --}}
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <a href="{{ route('findings.index') }}"
                   class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    ← Kembali
                </a>

                <button onclick="window.print()"
                    class="rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-700">
                    Cetak / Simpan PDF
                </button>
            </div>

            {{-- Kertas formulir --}}
            <div id="formulir"
                 class="mx-auto max-w-[850px] bg-white px-8 py-10 shadow-xl sm:px-12">

                {{-- Header --}}
                <div class="border-b-2 border-slate-800 pb-5 text-center">
                    <h1 class="text-lg font-extrabold uppercase tracking-wide text-slate-900">
                        Formulir Ketidaksesuaian
                    </h1>

                    <p class="mt-2 text-sm font-bold uppercase leading-relaxed text-slate-800">
                        Penerapan Sistem Manajemen Keselamatan Pertambangan
                    </p>
                </div>

                {{-- Identitas --}}
                <div class="my-6 grid grid-cols-1 gap-3 text-sm sm:grid-cols-2">
                    <div class="rounded-lg border border-slate-300 p-3">
                        <p class="text-xs font-semibold uppercase text-slate-500">
                            Tanggal Audit
                        </p>
                        <p class="mt-1 font-bold text-slate-900">
                            {{ $finding->audit_date?->format('d-m-Y') ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-lg border border-slate-300 p-3">
                        <p class="text-xs font-semibold uppercase text-slate-500">
                            Nomor Ketidaksesuaian
                        </p>
                        <p class="mt-1 font-bold text-slate-900">
                            {{ $nomorKetidaksesuaian ?: '-' }}
                        </p>
                    </div>
                </div>

                {{-- Judul bagian --}}
                <div class="mb-0 bg-slate-800 px-4 py-3 text-sm font-bold uppercase tracking-wide text-white">
                    Uraian Ketidaksesuaian
                </div>

                {{-- Tabel formulir --}}
                <table class="w-full border-collapse text-sm">
                    <tbody>
                        @php
                            $rows = [
                                ['Uraian Masalah (Problem)', $finding->problem],
                                ['Kategori', $kategori],
                                ['Area/Lokasi (Location)', $lokasi],
                                ['Bukti (Objective Evidence)', $finding->objective],
                                ['Referensi (Reference)', $finding->standard],
                                ['Elemen', null],
                                ['Sub Elemen', null],
                                ['Matriks', $finding->matriks],
                                ['Risiko', $finding->risk],
                                ['Deskripsi / Rekomendasi', $finding->recommendation],
                            ];
                        @endphp

                        @foreach ($rows as [$label, $value])
                            <tr>
                                <td class="w-[34%] border border-slate-400 bg-slate-50 px-3 py-3 align-top font-semibold text-slate-800">
                                    {{ $label }}
                                </td>

                                <td class="border border-slate-400 px-3 py-3 align-top leading-relaxed text-slate-700">
                                    @if (filled($value))
                                        {!! nl2br(e($value)) !!}
                                    @else
                                        <span class="text-slate-300">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Footer --}}
                <div class="mt-8 flex flex-col justify-between gap-2 border-t border-slate-300 pt-3 text-xs text-slate-500 sm:flex-row">
                    <span>Formulir Ketidaksesuaian Audit SMKP</span>
                    <span>Nomor Temuan: {{ $finding->finding_no ?: '-' }}</span>
                </div>

            </div>
        </div>
    </div>

    {{-- Pengaturan cetak --}}
    <style>
        @media print {
            body {
                background: white !important;
            }

            body * {
                visibility: hidden;
            }

            #formulir,
            #formulir * {
                visibility: visible;
            }

            #formulir {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                max-width: none;
                padding: 12mm;
                box-shadow: none;
            }

            @page {
                size: A4;
                margin: 8mm;
            }

            tr {
                break-inside: avoid;
            }
        }
    </style>
</x-app-layout>
@section('title', 'SMKP UTSG - Laporan')

<x-app-layout>
    <div class="min-h-screen bg-slate-50/80 px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-[1600px] space-y-6">

            {{-- HEADER --}}
            <div
                class="flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M8 3h7l5 5v13H4V3h4zm7 0v5h5M8 13h8M8 17h8" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-bold text-slate-800 sm:text-2xl">
                            Laporan Kesesuaian Audit SMKP
                        </h1>
                        <p class="mt-1 text-sm text-slate-500">
                            Cetak formulir kesesuaian berdasarkan hasil checklist audit yang telah selesai.
                        </p>
                    </div>
                </div>

                <span
                    class="inline-flex w-fit items-center rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                    {{ $audits->count() }} Audit Selesai
                </span>
            </div>

            {{-- TABEL AUDIT --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="font-bold text-slate-800">Daftar Audit</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Pilih audit untuk mencetak formulir kesesuaian dalam format PDF.
                    </p>
                </div>

                @if ($audits->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[1000px] text-left text-sm">
                            <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                                <tr>
                                    <th class="px-6 py-4 text-center">No.</th>
                                    <th class="px-6 py-4">Nama Audit</th>
                                    <th class="px-6 py-4">Site</th>
                                    <th class="px-6 py-4 text-center">Tanggal Mulai</th>
                                    <th class="px-6 py-4 text-center">Tanggal Selesai</th>
                                    <th class="px-6 py-4 text-center">Auditor</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @foreach ($audits as $audit)
                                    <tr class="transition hover:bg-slate-50">
                                        <td class="px-6 py-4 text-center text-slate-400">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <p class="font-semibold text-slate-800">
                                                {{ $audit->title }}
                                            </p>
                                            <p class="mt-1 text-xs text-emerald-700">
                                                Audit selesai
                                            </p>
                                        </td>

                                        <td class="px-6 py-4 text-slate-600">
                                            {{ $audit->site?->site_name ?? '-' }}
                                        </td>

                                        {{-- Tanggal Awal --}}
                                        <td class="whitespace-nowrap px-6 py-4 text-center text-slate-600">
                                            {{ $audit->audit_start_date?->format('d/m/Y') ?? '-' }}
                                        </td>

                                        {{-- Tanggal Akhir --}}
                                        <td class="whitespace-nowrap px-6 py-4 text-center text-slate-600">
                                            {{ $audit->audit_end_date?->format('d/m/Y') ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4 text-center text-slate-600">
                                            {{ $audit->auditor?->name ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            <a href="{{ route('laporan.kesesuaian-pdf', $audit) }}"
                                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.8" d="M12 3v12m0 0l-4-4m4 4l4-4M5 17v3h14v-3" />
                                                </svg>
                                                Cetak PDF
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-6 py-16 text-center">
                        <div
                            class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8 3h7l5 5v13H4V3h4zm7 0v5h5M8 13h8M8 17h8" />
                            </svg>
                        </div>

                        <h3 class="font-bold text-slate-800">Belum Ada Laporan</h3>
                        <p class="mt-2 text-sm text-slate-500">
                            Audit yang sudah selesai akan muncul di halaman ini.
                        </p>

                        <a href="{{ route('audit.index') }}"
                            class="mt-5 inline-flex items-center rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700">
                            Buka Audit SMKP
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

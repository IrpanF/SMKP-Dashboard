 @section('title', 'SMKP UTSG - Verifikasi')

 <x-app-layout>
    <div class="min-h-screen bg-slate-50 px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            {{-- HEADER --}}
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-slate-800">
                        Verifikasi Temuan Audit
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Periksa RTL dan bukti perbaikan yang dikirim auditee.
                    </p>
                </div>

                <div class="inline-flex w-fit items-center gap-2 rounded-xl border border-amber-200 bg-amber-50 px-4 py-2.5">
                    <svg class="h-5 w-5 text-amber-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    </svg>
                    <span class="text-sm font-semibold text-amber-700">
                        {{ $findings->count() }} Menunggu Verifikasi
                    </span>
                </div>
            </div>

            {{-- ALERT SUCCESS --}}
            @if (session('success'))
                <div class="mb-5 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
                    <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- ALERT ERROR --}}
            @if (session('error'))
                <div class="mb-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            {{-- TABLE CARD --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- TABLE HEADER --}}
                <div class="flex flex-col gap-2 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="font-semibold text-slate-800">
                            Daftar RTL Menunggu Verifikasi
                        </h3>
                        <p class="mt-1 text-xs text-slate-500">
                            Temuan yang telah dikirim auditee untuk diperiksa auditor.
                        </p>
                    </div>
                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[950px] text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-5 py-4 font-semibold">No.</th>
                                <th class="px-5 py-4 font-semibold">Nomor Temuan</th>
                                <th class="px-5 py-4 font-semibold">Audit</th>
                                <th class="px-5 py-4 font-semibold">Lokasi</th>
                                <th class="px-5 py-4 font-semibold">Auditee</th>
                                <th class="px-5 py-4 font-semibold">Tanggal</th>
                                <th class="px-5 py-4 text-center font-semibold">Status</th>
                                <th class="px-5 py-4 text-center font-semibold">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($findings as $finding)
                                <tr class="transition hover:bg-slate-50/80">

                                    {{-- NOMOR URUT --}}
                                    <td class="whitespace-nowrap px-5 py-4 text-slate-500">
                                        {{ $loop->iteration }}
                                    </td>

                                    {{-- NOMOR TEMUAN --}}
                                    <td class="whitespace-nowrap px-5 py-4">
                                        <span class="font-semibold text-slate-800">
                                            {{ $finding->finding_no ?: '-' }}
                                        </span>
                                    </td>

                                    {{-- AUDIT --}}
                                    <td class="px-5 py-4">
                                        <span class="font-medium text-slate-700">
                                            {{ $finding->audit?->title ?? 'Audit SMKP' }}
                                        </span>
                                    </td>

                                    {{-- LOKASI --}}
                                    <td class="px-5 py-4 text-slate-600">
                                        {{ $finding->location_name ?: '-' }}
                                    </td>

                                    {{-- AUDITEE --}}
                                    <td class="px-5 py-4">
                                        <span class="text-slate-700">
                                            {{ $finding->auditee ?: '-' }}
                                        </span>
                                    </td>

                                    {{-- TANGGAL --}}
                                    <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                        <div class="flex items-center gap-2">
                                            <svg class="h-4 w-4 text-slate-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v14H4V6a1 1 0 011-1z" />
                                            </svg>
                                            {{ $finding->updated_at?->format('d/m/Y') ?? '-' }}
                                        </div>
                                    </td>

                                    {{-- STATUS --}}
                                    <td class="whitespace-nowrap px-5 py-4 text-center">
                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-amber-200 bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                            Menunggu Verifikasi
                                        </span>
                                    </td>

                                    {{-- AKSI --}}
                                    <td class="whitespace-nowrap px-5 py-4 text-center">
                                        <a href="{{ route('verification.show', $finding->id) }}"
                                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-3.5 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                                            <svg class="h-4 w-4" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M2.46 12C3.73 7.94 7.52 5 12 5s8.27 2.94 9.54 7c-1.27 4.06-5.06 7-9.54 7s-8.27-2.94-9.54-7z" />
                                            </svg>
                                            Periksa RTL
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-5 py-16 text-center">
                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100">
                                            <svg class="h-7 w-7 text-slate-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.7"
                                                    d="M9 12l2 2 4-4m5-3v7a8 8 0 11-16 0V7l8-4 7 4z" />
                                            </svg>
                                        </div>

                                        <p class="mt-4 font-semibold text-slate-700">
                                            Belum Ada RTL Menunggu Verifikasi
                                        </p>
                                        <p class="mt-1 text-sm text-slate-500">
                                            RTL yang dikirim auditee akan muncul di tabel ini.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- TABLE FOOTER --}}
                @if ($findings->isNotEmpty())
                    <div class="border-t border-slate-200 bg-slate-50/70 px-5 py-3">
                        <p class="text-xs text-slate-500">
                            Menampilkan
                            <span class="font-semibold text-slate-700">{{ $findings->count() }}</span>
                            temuan yang menunggu verifikasi.
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
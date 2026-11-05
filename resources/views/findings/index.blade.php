@section('title', 'SMKP UTSG - Temuan')

<x-app-layout>
    <div class="min-h-screen bg-slate-50/80 px-4 py-6 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-[1600px] space-y-6">

            {{-- HEADER --}}
            <div
                class="flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:p-7">
                <div class="flex items-start gap-4">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 12h6m-6 4h6" />
                        </svg>
                    </div>

                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <h1 class="text-xl font-bold tracking-tight text-slate-800 sm:text-2xl">
                                Temuan Audit SMKP
                            </h1>
                            <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                Modul Audit
                            </span>
                        </div>
                        <p class="mt-1.5 max-w-2xl text-sm leading-6 text-slate-500">
                            Kelola, tinjau, dan pantau temuan hasil audit keselamatan pertambangan.
                        </p>
                    </div>
                </div>

                <a href="{{ route('findings.create') }}"
                    class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Temuan
                </a>
            </div>

            {{-- NOTIFIKASI --}}
            @if (session('success'))
                <div
                    class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3.5 text-sm text-emerald-800">
                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3.5 text-sm text-red-700">
                    <p class="mb-1 font-semibold">Periksa kembali data:</p>
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- RINGKASAN --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 12h6m-6 4h6" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Temuan</p>
                        <p class="mt-1 text-2xl font-bold tracking-tight text-slate-800">
                            {{ $findings->total() }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-50 text-sky-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Tanggal Hari Ini</p>
                        <p class="mt-1 text-lg font-bold tracking-tight text-slate-800">
                            {{ now()->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- TABEL --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- FORM EKSPOR TEMUAN TERPILIH --}}
                <form id="form-export-selected" action="{{ route('findings.export-pdf-selected') }}" method="POST">
                    @csrf
                </form>

                <div
                    class="flex flex-col gap-2 border-b border-slate-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <div>
                        <h2 class="text-base font-bold text-slate-800">Daftar Temuan</h2>
                        <p class="mt-1 text-sm text-slate-500">
                            @if ($selectedSite)
                                Menampilkan temuan untuk Site {{ $selectedSite }}.
                            @else
                                Data temuan audit dari seluruh Site yang dapat kamu akses.
                            @endif
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route(
                            'findings.index',
                            array_filter([
                                'site' => $selectedSite,
                                'per_page' => $perPage,
                                'category' => $selectedCategory === 'ofi' ? null : 'ofi',
                            ]),
                        ) }}"
                            class="inline-flex items-center justify-center gap-2 rounded-lg border border-emerald-200 bg-white px-3 py-2 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-50">

                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M4 6h16M7 12h10m-7 6h4" />
                            </svg>

                            {{ $selectedCategory === 'ofi' ? 'All' : 'OFI' }}
                        </a>

                        <form method="GET" action="{{ route('findings.index') }}"
                            class="flex w-full shrink-0 items-center gap-2 sm:w-auto">

                            <select id="filter-site" name="site" onchange="this.form.submit()"
                                aria-label="Filter berdasarkan Site"
                                class="w-64 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">

                                <option value="">Semua Site</option>

                                @foreach ($sites as $site)
                                    <option value="{{ $site->site_name }}" @selected($selectedSite === $site->site_name)>
                                        {{ $site->site_name }}
                                    </option>
                                @endforeach
                            </select>

                            <select name="per_page" onchange="this.form.submit()" aria-label="Jumlah temuan per halaman"
                                class="w-24 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">

                                @foreach ([5, 10, 15, 20, 25] as $limit)
                                    <option value="{{ $limit }}" @selected($perPage == $limit)>
                                        {{ $limit }} Data
                                    </option>
                                @endforeach
                            </select>

                            {{-- @if ($selectedSite)
                                <a href="{{ route('findings.index') }}"
                                    class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50">
                                    Reset
                                </a>
                            @endif --}}
                        </form>

                        {{-- <span
                            class="inline-flex w-fit items-center gap-2 rounded-lg bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-600">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                            <span>
                                {{ $findings->count() }}
                                {{ $selectedCategory === 'ofi' ? 'OFI' : 'data' }}
                            </span>
                        </span> --}}

                        <button type="button" onclick="openExportModal('internal')"
                            class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-rose-600 bg-rose-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-200"
                            title="Export temuan terpilih ke PDF">

                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M7 3.5h7l5 5V20a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2V5.5a2 2 0 0 1 2-2Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M14 3.5V9h5M8 13h8M8 16h8" />
                            </svg>

                            Export ke PDF
                        </button>

                        <button type="button" onclick="openExportModal('external')"
                            class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-blue-600 bg-blue-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200">

                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M7 3.5h7l5 5V20a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2V5.5a2 2 0 0 1 2-2Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M14 3.5V9h5M8 13h8M8 16h8" />
                            </svg>
                            Export Eksternal ke PDF
                        </button>

                        <button type="button" onclick="openExportModal('ofi')"
                            class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-emerald-600 bg-emerald-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-200"
                            title="Export temuan OFI ke PDF">

                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M7 3.5h7l5 5V20a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2V5.5a2 2 0 0 1 2-2Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M14 3.5V9h5M8 13h8M8 16h8" />
                            </svg>

                            Export OFI ke PDF
                        </button>

                    </div>

                </div>

                @if ($findings->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[950px] text-left text-sm">
                            <thead
                                class="bg-slate-50/90 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                <tr>
                                    <th class="w-14 px-4 py-4 text-center">
                                        <input type="checkbox" id="select-all-findings"
                                            class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                            title="Pilih semua temuan">
                                    </th>
                                    <th class="w-16 px-5 py-4 text-center">No.</th>
                                    <th class="px-5 py-4">Nomor Temuan</th>
                                    <th class="px-5 py-4">Audit</th>
                                    <th class="px-5 py-4">Tanggal Audit</th>
                                    <th class="px-5 py-4">Lokasi</th>
                                    <th class="px-5 py-4 text-center">Kategori</th>
                                    <th class="px-5 py-4 text-center">Kriteria</th>
                                    <th class="px-5 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @foreach ($findings as $finding)
                                    <tr data-category="{{ strtolower(trim($finding->finding_category ?? '')) }}"
                                        class="finding-row transition-colors hover:bg-slate-50/80">

                                        {{-- CHECKBOX PILIH TEMUAN --}}
                                        <td class="px-4 py-4 text-center">
                                            <input type="checkbox" name="findings[]" value="{{ $finding->id }}"
                                                form="form-export-selected"
                                                class="finding-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                                data-category="{{ strtolower($finding->finding_category ?? '') }}"
                                                data-site="{{ trim($finding->location_name ?? '') }}"
                                                aria-label="Pilih temuan {{ $finding->finding_no }}">
                                        </td>

                                        {{-- NOMOR URUT --}}
                                        <td class="px-5 py-4 text-center text-slate-400">
                                            {{ $findings->firstItem() + $loop->index }}
                                        </td>

                                        <td class="whitespace-nowrap px-5 py-4">
                                            <span class="font-bold text-slate-800">
                                                {{ $finding->finding_no }}
                                            </span>
                                        </td>

                                        <td class="max-w-xs px-5 py-4">
                                            <p class="truncate font-medium text-slate-700"
                                                title="{{ $finding->audit?->title ?? '-' }}">
                                                {{ $finding->audit?->title ?? '-' }}
                                            </p>
                                        </td>

                                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                            {{ $finding->audit_date?->format('d/m/Y') ?? '-' }}
                                        </td>

                                        <td class="px-5 py-4 text-slate-600">
                                            {{ $finding->location_name ?: '-' }}
                                        </td>
                                        {{-- KATEGORI TEMUAN --}}
                                        <td class="whitespace-nowrap px-5 py-4 text-center">
                                            @php
                                                $category = strtolower($finding->finding_category ?? '');

                                                $categoryStyles = [
                                                    'critical' => 'border-red-200 bg-red-50 text-red-700',
                                                    'mayor' => 'border-orange-200 bg-orange-50 text-orange-700',
                                                    'minor' => 'border-amber-200 bg-amber-50 text-amber-700',
                                                    'ofi' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
                                                ];

                                                $categoryLabels = [
                                                    'critical' => 'Critical',
                                                    'mayor' => 'Mayor',
                                                    'minor' => 'Minor',
                                                    'ofi' => 'OFI',
                                                ];

                                                $badgeStyle =
                                                    $categoryStyles[$category] ??
                                                    'border-slate-200 bg-slate-50 text-slate-600';
                                                $badgeLabel =
                                                    $categoryLabels[$category] ??
                                                    ($finding->finding_category ?: 'Belum diatur');
                                            @endphp

                                            <span
                                                class="inline-flex items-center rounded-lg border px-3 py-1.5 text-xs font-bold {{ $badgeStyle }}">
                                                {{ $badgeLabel }}
                                            </span>
                                        </td>

                                        <td class="px-5 py-4 text-center">
                                            <span
                                                class="inline-flex items-center rounded-lg border border-emerald-100 bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700">
                                                {{ $finding->finding_criteria }}
                                            </span>
                                        </td>

                                        {{-- AKSI SEJAJAR --}}
                                        <td class="whitespace-nowrap px-5 py-4">
                                            <div class="flex items-center justify-center gap-2">

                                                {{-- <a href="{{ route('findings.preview', $finding->id) }}" target="_blank"
                                                    class="inline-flex items-center rounded-lg bg-sky-600 px-3 py-2 text-sm font-semibold text-white hover:bg-sky-700">
                                                    Preview Formulir
                                                </a> --}}
                                                {{-- <a href="{{ route('findings.export-pdf') }}"
                                                    class="inline-flex items-center rounded-lg bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-rose-700">
                                                    Export PDF Temuan
                                                </a> --}}
                                                <a href="{{ route('findings.export-word', $finding->id) }}"
                                                    class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-200"
                                                    title="Export formulir ketidaksesuaian ke Word">

                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.8"
                                                            d="M12 3v12m0 0l-4-4m4 4l4-4M5 17v3h14v-3" />
                                                    </svg>

                                                    Word
                                                </a>

                                                <a href="{{ route('findings.show', $finding->id) }}"
                                                    class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-sky-200 bg-sky-50 px-3 py-2 text-xs font-semibold text-sky-700 transition hover:bg-sky-100 focus:outline-none focus:ring-2 focus:ring-sky-200">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.8"
                                                            d="M2.5 12s3.5-7 9.5-7 9.5 7 9.5 7-3.5 7-9.5 7-9.5-7-9.5-7z" />
                                                    </svg>
                                                    Detail
                                                </a>

                                                <form action="{{ route('findings.destroy', $finding->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus temuan audit ini? Data yang dihapus tidak dapat dikembalikan.');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-200">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.8"
                                                                d="M4 7h16M10 11v6m4-6v6M5 7l1 14h12l1-14M9 7V4h6v3" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div
                        class="flex flex-col gap-4 border-t border-slate-100 bg-slate-50/50 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">

                        <p class="text-xs text-slate-500">
                            Menampilkan
                            <span class="font-semibold text-slate-700">
                                {{ $findings->firstItem() ?? 0 }}
                                -
                                {{ $findings->lastItem() ?? 0 }}
                            </span>
                            dari
                            <span class="font-semibold text-slate-700">
                                {{ $findings->total() }}
                            </span>
                            temuan audit.
                        </p>

                        <div>
                            {{ $findings->onEachSide(1)->links('vendor.pagination.tailwind') }}
                        </div>

                    </div>
                @else
                    {{-- EMPTY STATE --}}
                    <div class="px-6 py-16 text-center">
                        <div
                            class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 12h6m-6 4h6" />
                            </svg>
                        </div>

                        <h3 class="text-lg font-bold text-slate-800">Belum Ada Temuan</h3>
                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                            Belum ada temuan audit yang tercatat. Mulai dengan menambahkan temuan baru untuk
                            mendokumentasikan hasil audit SMKP.
                        </p>

                        <a href="{{ route('findings.create') }}"
                            class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Temuan Pertama
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- MODAL FILTER EXPORT PDF --}}
    <div id="exportPdfModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm">

        <div class="w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl">

            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">
                        Export Laporan Temuan
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Pilih site dan tanggal audit terlebih dahulu.
                    </p>
                </div>

                <button type="button" onclick="closeExportModal()"
                    class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 6l12 12M18 6L6 18" />
                    </svg>
                </button>
            </div>

            {{-- Form filter --}}
            <div class="space-y-5 px-6 py-5">

                <div>
                    <label for="export-site" class="mb-1.5 block text-sm font-semibold text-slate-700">
                        Site <span class="text-rose-500">*</span>
                    </label>

                    <select id="export-site" required
                        class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm text-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100">
                        <option value="">Pilih Site</option>

                        @foreach ($sites as $site)
                            <option value="{{ $site->site_name }}" @selected($selectedSite === $site->site_name)>
                                {{ $site->site_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="export-date" class="mb-1.5 block text-sm font-semibold text-slate-700">
                        Tanggal Audit <span class="text-rose-500">*</span>
                    </label>

                    <input type="date" id="export-date" required
                        class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm text-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100">
                </div>

                <p id="export-error" class="hidden text-sm text-rose-600">
                    Silakan pilih site dan tanggal audit.
                </p>

                {{-- Tombol --}}
                <div class="flex justify-end gap-3 border-t border-slate-100 pt-4">
                    <button type="button" onclick="closeExportModal()"
                        class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                        Batal
                    </button>

                    <button type="button" onclick="submitExportPdf()"
                        class="inline-flex items-center gap-2 rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-rose-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v12m0 0l-4-4m4 4l4-4M5 17v3h14v-3" />
                        </svg>
                        Lanjut Export PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let exportType = 'internal';

        function openExportModal(type = 'internal') {
            exportType = type;

            const modal = document.getElementById('exportPdfModal');
            const error = document.getElementById('export-error');
            const title = modal.querySelector('h3');
            const description = modal.querySelector('h3 + p');
            const submitButton = modal.querySelector(
                'button[onclick="submitExportPdf()"]'
            );

            const exportSite = document.getElementById('export-site');
            const filterSite = document.getElementById('filter-site');

            const selected = Array.from(
                document.querySelectorAll('.finding-checkbox:checked')
            );

            const selectedSites = [
                ...new Set(
                    selected
                    .map(checkbox => (checkbox.dataset.site || '').trim())
                    .filter(Boolean)
                )
            ];

            // Prioritas: Site dari temuan terpilih.
            // Jika belum ada temuan dipilih, gunakan filter tabel.
            let siteToSelect = '';

            if (selectedSites.length === 1) {
                siteToSelect = selectedSites[0];
            } else if (selectedSites.length === 0 && filterSite?.value) {
                siteToSelect = filterSite.value.trim();
            }

            if (exportSite) {
                const matchingOption = Array.from(exportSite.options).find(
                    option => option.value.trim() === siteToSelect
                );

                if (siteToSelect && matchingOption) {
                    exportSite.value = matchingOption.value;
                } else if (selectedSites.length > 1) {
                    // Pilihan berasal dari beberapa Site berbeda.
                    exportSite.value = '';
                } else if (!siteToSelect) {
                    exportSite.value = '';
                }
            }

            const titles = {
                internal: 'Export Laporan Temuan Internal',
                external: 'Export Rekapitulasi Eksternal',
                ofi: 'Export Rekomendasi dan Peluang Perbaikan (OFI)'
            };

            if (title) {
                title.textContent = titles[type] || titles.internal;
            }

            if (description) {
                description.textContent = type === 'ofi' ?
                    'Pilih site dan tanggal audit untuk formulir OFI.' :
                    'Pilih site dan tanggal laporan terlebih dahulu.';
            }

            if (submitButton) {
                submitButton.classList.remove(
                    'bg-blue-600', 'hover:bg-blue-700',
                    'bg-rose-600', 'hover:bg-rose-700',
                    'bg-emerald-600', 'hover:bg-emerald-700'
                );

                const colors = {
                    internal: ['bg-rose-600', 'hover:bg-rose-700'],
                    external: ['bg-blue-600', 'hover:bg-blue-700'],
                    ofi: ['bg-emerald-600', 'hover:bg-emerald-700']
                };

                (colors[type] || colors.internal).forEach(className => {
                    submitButton.classList.add(className);
                });
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            error.classList.add('hidden');
            error.textContent = '';
        }

        function closeExportModal() {
            const modal = document.getElementById('exportPdfModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function submitExportPdf() {
            const site = document.getElementById('export-site').value;
            const date = document.getElementById('export-date').value;
            const error = document.getElementById('export-error');
            const exportForm = document.getElementById('form-export-selected');

            if (!site || !date) {
                error.textContent = 'Silakan pilih site dan tanggal laporan.';
                error.classList.remove('hidden');
                return;
            }

            if (!exportForm) {
                alert('Form export PDF tidak ditemukan.');
                return;
            }

            const selected = Array.from(
                document.querySelectorAll('.finding-checkbox:checked')
            );

            if (selected.length === 0) {
                error.textContent = 'Pilih minimal satu temuan terlebih dahulu.';
                error.classList.remove('hidden');
                return;
            }

            const internalUrl = @json(route('findings.export-pdf-selected'));
            const externalUrl = @json(route('findings.export-external-pdf-selected'));
            const ofiUrl = @json(route('findings.export-ofi-pdf-selected'));

            // Tentukan endpoint berdasarkan jenis laporan.
            const exportUrls = {
                internal: internalUrl,
                external: externalUrl,
                ofi: ofiUrl
            };

            // Khusus OFI, pastikan yang dipilih memang berkategori OFI.
            if (exportType === 'ofi') {
                const nonOfiSelected = selected.some(function(checkbox) {
                    const row = checkbox.closest('tr');
                    const category = (
                        checkbox.dataset.category ||
                        row?.dataset.category ||
                        ''
                    ).toLowerCase();

                    return category !== 'ofi';
                });

                if (nonOfiSelected) {
                    error.textContent =
                        'Untuk ekspor OFI, pilih hanya temuan berkategori OFI.';
                    error.classList.remove('hidden');
                    return;
                }
            }

            exportForm.action = exportUrls[exportType] || internalUrl;

            // Masukkan site dan tanggal ke form.
            [{
                    name: 'site',
                    value: site
                },
                {
                    name: 'audit_date',
                    value: date
                }
            ].forEach(function(item) {
                let input = exportForm.querySelector(
                    'input[type="hidden"][name="' + item.name + '"]'
                );

                if (!input) {
                    input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = item.name;
                    exportForm.appendChild(input);
                }

                input.value = item.value;
            });

            closeExportModal();
            exportForm.submit();
        }

        // Tutup modal jika area luar diklik.
        document.getElementById('exportPdfModal').addEventListener(
            'click',
            function(event) {
                if (event.target === this) {
                    closeExportModal();
                }
            }
        );

        // Tutup modal dengan tombol Escape.
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeExportModal();
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('select-all-findings');
            const checkboxes = document.querySelectorAll('.finding-checkbox');
            const form = document.getElementById('form-export-selected');

            function updateSelectAll() {
                const selectedCount = document.querySelectorAll(
                    '.finding-checkbox:checked'
                ).length;

                if (selectAll) {
                    selectAll.checked =
                        checkboxes.length > 0 &&
                        selectedCount === checkboxes.length;

                    selectAll.indeterminate =
                        selectedCount > 0 &&
                        selectedCount < checkboxes.length;
                }
            }

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = selectAll.checked;
                    });

                    selectAll.indeterminate = false;
                });
            }

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', updateSelectAll);
            });

            if (form) {
                form.addEventListener('submit', function(event) {
                    const selected = document.querySelectorAll(
                        '.finding-checkbox:checked'
                    );

                    if (selected.length === 0) {
                        event.preventDefault();
                        alert('Pilih minimal satu temuan terlebih dahulu.');
                    }
                });
            }
        });
    </script>
</x-app-layout>

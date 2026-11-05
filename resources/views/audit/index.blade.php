@section('title', 'SMKP UTSG - Audit Checklist')

<x-app-layout>
    <div class="min-h-screen bg-slate-50 p-4 sm:p-6 lg:p-8">
        <div class="mx-auto max-w-7xl">

            {{-- HEADER --}}
            <div class="mb-8 flex flex-col justify-between gap-5 sm:flex-row sm:items-center">
                <div>
                    <div class="mb-2 flex items-center gap-2 text-sm font-semibold text-emerald-700">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8 4.75h8A2.25 2.25 0 0 1 18.25 7v13H5.75V7A2.25 2.25 0 0 1 8 4.75ZM9 4.75v-2h6v2M8.5 10h7M8.5 13.5h7M8.5 17h4" />
                            </svg>
                        </span>
                        Audit SMKP
                    </div>

                    <h1 class="text-2xl font-bold tracking-tight text-slate-800 sm:text-3xl">
                        Daftar Audit
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Kelola audit, pantau progres, dan periksa hasil penilaian SMKP.
                    </p>
                </div>

                <a href="{{ route('audit.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m-7-7h14" />
                    </svg>
                    Buat Audit Baru
                </a>
            </div>

            {{-- NOTIFIKASI --}}
            @if (session('success'))
                <div
                    class="mb-5 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
                    <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 12 4 4L19 6" />
                    </svg>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="mb-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v4m0 4h.01M10.3 3.86 1.82 18.5A2 2 0 0 0 3.55 21.5h16.9a2 2 0 0 0 1.73-3L13.73 3.86a2 2 0 0 0-3.46 0Z" />
                    </svg>
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif

            {{-- STATISTIK --}}
            <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-3">

                {{-- TOTAL AUDIT --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md sm:p-6">
                    <div
                        class="absolute right-0 top-0 h-24 w-24 rounded-bl-full bg-emerald-50/80 transition group-hover:bg-emerald-100/70">
                    </div>

                    <div class="relative flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">Total Audit</p>
                            <p class="mt-4 text-4xl font-extrabold tracking-tight text-slate-800">
                                {{ $audits->count() }}
                            </p>
                            <p class="mt-2 text-xs text-slate-500">
                                Seluruh audit yang dibuat akun ini
                            </p>
                        </div>

                        <span
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700 ring-4 ring-emerald-50">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8 4.75h8A2.25 2.25 0 0 1 18.25 7v13H5.75V7A2.25 2.25 0 0 1 8 4.75ZM9 4.75v-2h6v2M8.5 10h7M8.5 13.5h7M8.5 17h4" />
                            </svg>
                        </span>
                    </div>

                    <div class="relative mt-5 h-1 overflow-hidden rounded-full bg-slate-100">
                        <div class="h-full w-full rounded-full bg-emerald-500"></div>
                    </div>
                </div>

                {{-- AUDIT DRAFT --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md sm:p-6">
                    <div
                        class="absolute right-0 top-0 h-24 w-24 rounded-bl-full bg-amber-50/80 transition group-hover:bg-amber-100/70">
                    </div>

                    <div class="relative flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">Dalam Pengerjaan</p>
                            <p class="mt-4 text-4xl font-extrabold tracking-tight text-amber-600">
                                {{ $audits->where('status', 'draft')->count() }}
                            </p>
                            <p class="mt-2 text-xs text-slate-500">
                                Audit yang masih berstatus Draft
                            </p>
                        </div>

                        <span
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-amber-100 text-amber-700 ring-4 ring-amber-50">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="9" stroke-width="1.8" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 7v5l3 2" />
                            </svg>
                        </span>
                    </div>

                    <div class="relative mt-5 h-1 overflow-hidden rounded-full bg-amber-50">
                        <div class="h-full w-full rounded-full bg-amber-400"></div>
                    </div>
                </div>

                {{-- AUDIT SELESAI --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md sm:p-6">
                    <div
                        class="absolute right-0 top-0 h-24 w-24 rounded-bl-full bg-blue-50/80 transition group-hover:bg-blue-100/70">
                    </div>

                    <div class="relative flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">Audit Selesai</p>
                            <p class="mt-4 text-4xl font-extrabold tracking-tight text-blue-700">
                                {{ $audits->where('status', 'completed')->count() }}
                            </p>
                            <p class="mt-2 text-xs text-slate-500">
                                Audit yang telah diselesaikan
                            </p>
                        </div>

                        <span
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-100 text-blue-700 ring-4 ring-blue-50">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="m5 12 4 4L19 6" />
                                <circle cx="12" cy="12" r="9" stroke-width="1.8" />
                            </svg>
                        </span>
                    </div>

                    <div class="relative mt-5 h-1 overflow-hidden rounded-full bg-blue-50">
                        <div class="h-full w-full rounded-full bg-blue-500"></div>
                    </div>
                </div>

            </div>

            {{-- DAFTAR AUDIT --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div
                    class="flex flex-col justify-between gap-2 border-b border-slate-100 px-5 py-5 sm:flex-row sm:items-center">
                    <div>
                        <h2 class="font-bold text-slate-800">Riwayat Audit</h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Pantau dan kelola seluruh audit kamu.
                        </p>
                    </div>

                    <span class="text-sm text-slate-500">
                        {{ $audits->count() }} audit
                    </span>
                </div>

                @forelse ($audits as $audit)
                    @php
                        $total = $audit->assessments_count;
                        $scored = $audit->scored_assessments_count;
                        $progress = $total > 0 ? min(100, round(($scored / $total) * 100)) : 0;
                    @endphp

                    <div
                        class="group border-b border-slate-100 p-5 transition last:border-b-0 hover:bg-slate-50/70 sm:px-6">

                        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                            {{-- INFORMASI AUDIT --}}
                            <div class="flex min-w-0 flex-1 items-start gap-4">

                                <div
                                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl
                                    {{ $audit->status === 'completed' ? 'bg-blue-50 text-blue-700' : 'bg-emerald-50 text-emerald-700' }}">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                            d="M8 4.75h8A2.25 2.25 0 0 1 18.25 7v13H5.75V7A2.25 2.25 0 0 1 8 4.75ZM9 4.75v-2h6v2M8.5 10h7M8.5 13.5h7M8.5 17h4" />
                                    </svg>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h3 class="break-words font-semibold text-slate-800">
                                            {{ $audit->title }}
                                        </h3>

                                        @if ($audit->status === 'completed')
                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                                <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                                Selesai
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                                Draft
                                            </span>
                                        @endif
                                    </div>

                                    <p class="mt-1.5 flex items-start gap-1.5 text-sm text-slate-500">
                                        <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                                d="M3 21h18M5 21V7l7-4 7 4v14M9 10h1m4 0h1m-6 4h1m4 0h1m-5 7v-4h2v4" />
                                        </svg>

                                        <span>
                                            <span class="font-medium text-slate-600">Site:</span>
                                            {{ $audit->site ? $audit->site->company_name . ' - Site ' . $audit->site->site_name : 'Belum ditentukan' }}
                                        </span>
                                    </p>

                                    <p class="mt-1.5 flex items-center gap-1.5 text-sm text-slate-500">
                                        <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <rect x="3.75" y="5.75" width="16.5" height="14.5" rx="2"
                                                stroke-width="1.6" />
                                            <path stroke-linecap="round" stroke-width="1.6"
                                                d="M8 3.75v4M16 3.75v4M4 10h16" />
                                        </svg>

                                        <span>
                                            <span class="font-medium text-slate-600">Periode audit:</span>
                                            {{ $audit->audit_start_date?->format('d/m/Y') ?? '-' }}
                                            <span class="mx-1 text-slate-400">s.d.</span>
                                            {{ $audit->audit_end_date?->format('d/m/Y') ?? '-' }}
                                        </span>
                                    </p>

                                    {{-- PROGRES --}}
                                    <div class="mt-4 max-w-md">
                                        <div class="mb-2 flex items-center justify-between gap-3 text-xs">
                                            <span class="font-medium text-slate-500">
                                                Progres penilaian
                                            </span>
                                            <span class="font-semibold text-slate-700">
                                                {{ $scored }}/{{ $total }}
                                                <span class="text-emerald-700">({{ $progress }}%)</span>
                                            </span>
                                        </div>

                                        <div class="h-2 overflow-hidden rounded-full bg-slate-100">
                                            <div class="h-full rounded-full transition-all
                                                {{ $audit->status === 'completed' ? 'bg-blue-500' : 'bg-emerald-500' }}"
                                                style="width: {{ $progress }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- AKSI AUDIT --}}
                            <div
                                class="flex items-center justify-between gap-3 border-t border-slate-100 pt-4 lg:justify-end lg:border-0 lg:pt-0">
                                <span class="text-xs font-medium text-slate-400 lg:hidden">
                                    Aksi audit
                                </span>

                                <div class="flex flex-wrap items-center gap-2">

                                    @if ($audit->status === 'completed')
                                        <a href="{{ route('audit.result', $audit) }}" title="Lihat hasil audit"
                                            class="inline-flex h-10 w-36 shrink-0 items-center justify-center gap-2 rounded-xl border border-blue-200 bg-blue-50 px-3 text-sm font-semibold text-blue-700 transition hover:bg-blue-100">
                                            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z" />
                                                <circle cx="12" cy="12" r="2.5" stroke-width="1.8" />
                                            </svg>
                                            <span>Lihat Hasil</span>
                                        </a>
                                    @else
                                        <a href="{{ route('audit.checklist', ['audit' => $audit->id]) }}"
                                            title="Lanjutkan audit"
                                            class="inline-flex h-10 w-36 shrink-0 items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-3 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-100">
                                            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.8" d="M12 3.5a8.5 8.5 0 1 0 8.5 8.5M12 7v5l3 2" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.8" d="M16 3.5h4.5V8" />
                                            </svg>
                                            <span>Lanjutkan</span>
                                        </a>
                                    @endif

                                    {{-- EDIT --}}
                                    <a href="{{ route('audit.edit', $audit) }}" title="Edit data audit"
                                        aria-label="Edit data audit"
                                        class="flex h-10 w-10 items-center justify-center rounded-xl border border-amber-200 bg-white text-amber-700 transition hover:bg-amber-50">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="m14.5 5.5 4 4M4 20l4.2-.8L19.5 7.9a2.12 2.12 0 0 0-3-3L5.2 16.2 4 20Z" />
                                        </svg>
                                    </a>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('audit.destroy', $audit) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus audit ini beserta seluruh penilaiannya? Tindakan ini tidak dapat dibatalkan.');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" title="Hapus audit" aria-label="Hapus audit"
                                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-red-200 bg-white text-red-600 transition hover:bg-red-50">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M4 7h16M10 11v6m4-6v6M5.5 7l1 13h11l1-13M9 7V4h6v3" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    {{-- EMPTY STATE --}}
                    <div class="px-5 py-16 text-center">
                        <div
                            class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-700">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8 4.75h8A2.25 2.25 0 0 1 18.25 7v13H5.75V7A2.25 2.25 0 0 1 8 4.75ZM8.5 10h7M8.5 13.5h7" />
                            </svg>
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-slate-800">
                            Belum ada audit
                        </h3>

                        <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-500">
                            Buat audit pertama untuk mulai mengisi checklist dan melakukan penilaian SMKP.
                        </p>

                        <a href="{{ route('audit.create') }}"
                            class="mt-6 inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5v14m-7-7h14" />
                            </svg>
                            Buat Audit Pertama
                        </a>
                    </div>
                @endforelse

            </div>

            <p class="mt-4 text-center text-xs text-slate-400">
                Sistem Manajemen Keselamatan Pertambangan
            </p>

        </div>
    </div>
</x-app-layout>

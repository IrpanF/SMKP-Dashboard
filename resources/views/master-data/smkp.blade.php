@section('title', 'SMKP UTSG - Master Data')

<x-app-layout>
    <div class="min-h-screen bg-slate-50 p-4 sm:p-6 lg:p-8">

        {{-- HEADER --}}
        <div class="mb-6">
            <p class="text-sm font-semibold text-emerald-700">
                Master Data
            </p>

            <h1 class="mt-1 text-2xl font-bold text-slate-800">
                Master Data SMKP
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Sistem Manajemen Keselamatan Pertambangan
            </p>
        </div>


        {{-- RINGKASAN STATISTIK --}}
        <div class="mb-7 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">

            {{-- TOTAL ELEMEN --}}
            <div
                class="group relative overflow-hidden rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-emerald-200 hover:shadow-lg hover:shadow-emerald-100/60 sm:p-6">
                <div
                    class="absolute -right-7 -top-7 h-24 w-24 rounded-full bg-emerald-50 transition group-hover:scale-125">
                </div>

                <div class="relative flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Elemen
                        </p>

                        <p class="mt-3 text-4xl font-extrabold tracking-tight text-emerald-700">
                            {{ $elements->count() }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            Struktur utama SMKP
                        </p>
                    </div>

                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700 ring-1 ring-emerald-200/70">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M4 6.5A1.5 1.5 0 0 1 5.5 5h4A1.5 1.5 0 0 1 11 6.5v4A1.5 1.5 0 0 1 9.5 12h-4A1.5 1.5 0 0 1 4 10.5v-4ZM13 6.5A1.5 1.5 0 0 1 14.5 5h4A1.5 1.5 0 0 1 20 6.5v4a1.5 1.5 0 0 1-1.5 1.5h-4A1.5 1.5 0 0 1 13 10.5v-4ZM4 16.5A1.5 1.5 0 0 1 5.5 15h4a1.5 1.5 0 0 1 1.5 1.5v4A1.5 1.5 0 0 1 9.5 22h-4A1.5 1.5 0 0 1 4 20.5v-4ZM13 16.5a1.5 1.5 0 0 1 1.5-1.5h4a1.5 1.5 0 0 1 1.5 1.5v4a1.5 1.5 0 0 1-1.5 1.5h-4a1.5 1.5 0 0 1-1.5-1.5v-4Z" />
                        </svg>
                    </div>
                </div>

                <div class="relative mt-5 h-1.5 overflow-hidden rounded-full bg-emerald-50">
                    <div class="h-full w-full rounded-full bg-emerald-500"></div>
                </div>
            </div>

            {{-- TOTAL KRITERIA --}}
            <div
                class="group relative overflow-hidden rounded-2xl border border-blue-100 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-100/60 sm:p-6">
                <div
                    class="absolute -right-7 -top-7 h-24 w-24 rounded-full bg-blue-50 transition group-hover:scale-125">
                </div>

                <div class="relative flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Kriteria
                        </p>

                        <p class="mt-3 text-4xl font-extrabold tracking-tight text-blue-700">
                            {{ \App\Models\SmkpCriteria::where('is_active', true)->count() }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            Kriteria aktif dalam sistem
                        </p>
                    </div>

                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-100 text-blue-700 ring-1 ring-blue-200/70">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                        </svg>
                    </div>
                </div>

                <div class="relative mt-5 h-1.5 overflow-hidden rounded-full bg-blue-50">
                    <div class="h-full w-full rounded-full bg-blue-500"></div>
                </div>
            </div>

            {{-- TOTAL INDIKATOR --}}
            <div
                class="group relative overflow-hidden rounded-2xl border border-violet-100 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-violet-200 hover:shadow-lg hover:shadow-violet-100/60 sm:col-span-2 xl:col-span-1 sm:p-6">
                <div
                    class="absolute -right-7 -top-7 h-24 w-24 rounded-full bg-violet-50 transition group-hover:scale-125">
                </div>

                <div class="relative flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Indikator
                        </p>

                        <p class="mt-3 text-4xl font-extrabold tracking-tight text-violet-700">
                            {{ \App\Models\SmkpIndicator::where('is_active', true)->count() }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            Indikator aktif dalam sistem
                        </p>
                    </div>

                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-violet-100 text-violet-700 ring-1 ring-violet-200/70">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2m-8 8 2 2 4-4" />
                        </svg>
                    </div>
                </div>

                <div class="relative mt-5 h-1.5 overflow-hidden rounded-full bg-violet-50">
                    <div class="h-full w-full rounded-full bg-violet-500"></div>
                </div>
            </div>

        </div>


        @php
            $rubricsByCriteria = \App\Models\SmkpCriteriaRubric::query()
                ->orderBy('permit_type')
                ->orderBy('score_level')
                ->get()
                ->groupBy('smkp_criteria_id');
        @endphp
        {{-- DAFTAR ELEMEN --}}
        <div class="overflow-hidden rounded-2xl
                    border border-slate-200 bg-white">

            <div
                class="flex flex-wrap items-center justify-between
                        gap-3 border-b border-slate-100 px-5 py-4">

                <div>
                    <h2 class="font-semibold text-slate-800">
                        Struktur Kriteria SMKP
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Klik elemen atau kriteria untuk melihat detail.
                    </p>
                </div>

                <button type="button"
                    onclick="document.querySelectorAll('[data-smkp-element]').forEach(el => el.open = !el.open)"
                    class="rounded-lg border border-slate-200
                           px-3 py-2 text-xs font-semibold
                           text-slate-600 transition
                           hover:bg-slate-50">
                    Buka / Tutup Elemen
                </button>
            </div>

            <div class="space-y-3 p-4 sm:p-5">

                @forelse ($elements as $element)
                    <details data-smkp-element
                        class="group rounded-xl border border-slate-200
                               bg-white">

                        <summary
                            class="flex cursor-pointer list-none
                                   items-center gap-3 rounded-xl
                                   px-4 py-4 transition
                                   hover:bg-emerald-50/50">

                            <div
                                class="flex h-11 w-11 shrink-0
                                        items-center justify-center
                                        rounded-xl bg-emerald-100
                                        text-sm font-bold
                                        text-emerald-800">
                                {{ $element->code }}
                            </div>

                            <div class="min-w-0 flex-1">
                                <h3
                                    class="text-sm font-bold
                                           text-slate-800 sm:text-base">
                                    {{ $element->name }}
                                </h3>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $element->criteria->count() }}
                                    kriteria tingkat pertama
                                </p>
                            </div>

                            <svg class="h-5 w-5 shrink-0 text-slate-400
                                       transition group-open:rotate-180"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 9-7 7-7-7" />
                            </svg>

                        </summary>

                        <div
                            class="border-t border-slate-100
                                    bg-slate-50/50 p-3 sm:p-5">

                            @if ($element->criteria->isNotEmpty())
                                @include('master-data.criteria', [
                                    'criteriaItems' => $element->criteria,
                                    'rubricsByCriteria' => $rubricsByCriteria,
                                ])
                            @else
                                <p class="p-4 text-sm text-slate-500">
                                    Belum ada kriteria untuk elemen ini.
                                </p>
                            @endif

                        </div>
                    </details>
                @empty
                    <div class="p-8 text-center text-slate-500">
                        Belum ada data elemen SMKP.
                    </div>
                @endforelse

            </div>
        </div>

    </div>
</x-app-layout>

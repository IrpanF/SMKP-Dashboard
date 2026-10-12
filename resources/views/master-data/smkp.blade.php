
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

        {{-- RINGKASAN --}}
        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">

            <div class="rounded-2xl border border-slate-200
                        bg-white p-5">
                <p class="text-sm text-slate-500">Total Elemen</p>
                <p class="mt-2 text-3xl font-bold text-emerald-700">
                    {{ $elements->count() }}
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200
                        bg-white p-5">
                <p class="text-sm text-slate-500">Total Kriteria</p>
                <p class="mt-2 text-3xl font-bold text-slate-800">
                    {{ \App\Models\SmkpCriteria::where('is_active', true)->count() }}
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200
                        bg-white p-5">
                <p class="text-sm text-slate-500">Total Indikator</p>
                <p class="mt-2 text-3xl font-bold text-slate-800">
                    {{ \App\Models\SmkpIndicator::where('is_active', true)->count() }}
                </p>
            </div>

        </div>

        {{-- DAFTAR ELEMEN --}}
        <div class="overflow-hidden rounded-2xl
                    border border-slate-200 bg-white">

            <div class="flex flex-wrap items-center justify-between
                        gap-3 border-b border-slate-100 px-5 py-4">

                <div>
                    <h2 class="font-semibold text-slate-800">
                        Struktur Kriteria SMKP
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Klik elemen atau kriteria untuk melihat detail.
                    </p>
                </div>

                <button
                    type="button"
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
                    <details
                        data-smkp-element
                        class="group rounded-xl border border-slate-200
                               bg-white">

                        <summary
                            class="flex cursor-pointer list-none
                                   items-center gap-3 rounded-xl
                                   px-4 py-4 transition
                                   hover:bg-emerald-50/50">

                            <div class="flex h-11 w-11 shrink-0
                                        items-center justify-center
                                        rounded-xl bg-emerald-100
                                        text-sm font-bold
                                        text-emerald-800">
                                {{ $element->code }}
                            </div>

                            <div class="min-w-0 flex-1">
                                <h3 class="text-sm font-bold
                                           text-slate-800 sm:text-base">
                                    {{ $element->name }}
                                </h3>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $element->criteria->count() }}
                                    kriteria tingkat pertama
                                </p>
                            </div>

                            <svg
                                class="h-5 w-5 shrink-0 text-slate-400
                                       transition group-open:rotate-180"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m19 9-7 7-7-7" />
                            </svg>

                        </summary>

                        <div class="border-t border-slate-100
                                    bg-slate-50/50 p-3 sm:p-5">

                            @if ($element->criteria->isNotEmpty())
                                @include('master-data.criteria', [
                                    'criteriaItems' => $element->criteria
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

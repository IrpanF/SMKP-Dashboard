@foreach ($criteriaItems as $criteria)
    @php
        $criteriaRubrics = $rubricsByCriteria->get($criteria->id, collect());

        $rubricsByPermitType = $criteriaRubrics->groupBy(
            fn ($rubric) => $rubric->permit_type ?: 'umum'
        );

        $validIndicators = $criteria->indicators
            ->filter(fn ($indicator) => filled(trim($indicator->indicator ?? '')))
            ->sortBy('sort_order')
            ->values();
    @endphp

    <details class="group mt-3 rounded-2xl">
        {{-- HEADER KRITERIA --}}
        <summary
            class="flex cursor-pointer list-none items-center gap-3 rounded-xl
                   border border-slate-200 bg-white px-4 py-3.5
                   shadow-sm transition duration-200
                   hover:border-emerald-300 hover:bg-emerald-50/40
                   hover:shadow-md
                   [&::-webkit-details-marker]:hidden">

            <span
                class="flex h-8 w-8 shrink-0 items-center justify-center
                       rounded-lg bg-slate-50 text-slate-500
                       ring-1 ring-slate-200 transition duration-200
                       group-open:rotate-90 group-open:bg-emerald-600
                       group-open:text-white group-open:ring-emerald-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="m9 5 7 7-7 7" />
                </svg>
            </span>

            <span
                class="shrink-0 rounded-lg border border-emerald-100
                       bg-emerald-50 px-2.5 py-1.5 text-xs font-bold
                       tracking-wide text-emerald-800">
                {{ $criteria->code }}
            </span>

            <span class="min-w-0 flex-1 text-sm font-semibold leading-6 text-slate-800">
                {{ $criteria->name }}
            </span>

            @if ($criteriaRubrics->isNotEmpty())
                <span
                    class="hidden shrink-0 rounded-full bg-emerald-50
                           px-2.5 py-1 text-xs font-semibold text-emerald-700
                           sm:inline-flex">
                    {{ $criteriaRubrics->count() }} kriteria
                </span>
            @elseif ($criteria->children->isNotEmpty())
                <span class="hidden shrink-0 text-xs font-medium text-slate-400 sm:inline">
                    {{ $criteria->children->count() }} subkriteria
                </span>
            @elseif ($validIndicators->isNotEmpty())
                <span class="hidden shrink-0 text-xs font-medium text-slate-400 sm:inline">
                    {{ $validIndicators->count() }} indikator
                </span>
            @endif
        </summary>

        {{-- ISI KRITERIA --}}
        <div class="ml-3 mt-2 border-l-2 border-emerald-100 py-2 pl-3 sm:ml-5 sm:pl-4">

            {{-- SUBKRITERIA --}}
            @if ($criteria->children->isNotEmpty())
                @include('master-data.criteria', [
                    'criteriaItems' => $criteria->children,
                    'rubricsByCriteria' => $rubricsByCriteria,
                ])
            @endif

            {{-- INDIKATOR REFERENSI --}}
            @if ($validIndicators->isNotEmpty())
                <div class="mt-3 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                    <div class="flex items-center gap-2 border-b border-slate-100 bg-slate-50/80 px-4 py-3">
                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                            </svg>
                        </span>

                        <div>
                            <h4 class="text-sm font-semibold text-slate-800">
                                Indikator Referensi
                            </h4>
                            <p class="text-xs text-slate-500">
                                Acuan pemeriksaan
                            </p>
                        </div>

                        <span class="ml-auto rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                            {{ $validIndicators->count() }} indikator
                        </span>
                    </div>

                    <ol class="divide-y divide-slate-100">
                        @foreach ($validIndicators as $index => $indicator)
                            <li class="flex items-start gap-3 px-4 py-3 transition hover:bg-slate-50/80">
                                <span
                                    class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center
                                           rounded-lg bg-slate-50 text-xs font-bold
                                           text-slate-600 ring-1 ring-slate-200">
                                    {{ $index + 1 }}
                                </span>

                                <p class="m-0 min-w-0 flex-1 whitespace-pre-line break-words text-sm leading-6 text-slate-700">{{ trim($indicator->indicator) }}</p>
                            </li>
                        @endforeach
                    </ol>
                </div>
            @endif

            {{-- KRITERIA PENILAIAN --}}
            @if ($criteriaRubrics->isNotEmpty())
                <div class="mt-3 overflow-hidden rounded-xl border border-emerald-200 bg-white shadow-sm">

                    {{-- JUDUL --}}
                    <div class="flex items-center gap-3 border-b border-emerald-100 bg-emerald-50/60 px-4 py-3.5">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-sm">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2m-8 8 2 2 4-4" />
                            </svg>
                        </span>

                        <div class="min-w-0 flex-1">
                            <h4 class="text-sm font-bold text-slate-800">
                                Kriteria Penilaian
                            </h4>
                            <p class="mt-0.5 text-xs leading-5 text-slate-500">
                                Deskripsi untuk setiap tingkat nilai
                            </p>
                        </div>
                    </div>

                    <div class="p-3 sm:p-4">
                        @foreach ($rubricsByPermitType as $permitType => $rubrics)
                            <div class="mb-4 last:mb-0">

                                {{-- JENIS IZIN --}}
                                @if ($rubricsByPermitType->count() > 1 || $permitType !== 'umum')
                                    <div class="mb-3 flex items-center gap-2">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        <p class="m-0 text-xs font-bold uppercase tracking-wide text-emerald-800">
                                            Jenis izin:
                                            {{ str_replace('_', ' / ', $permitType) }}
                                        </p>
                                    </div>
                                @endif

                                {{-- DAFTAR SKOR --}}
                                <div class="overflow-hidden rounded-xl border border-slate-200 divide-y divide-slate-100">
                                    @foreach ($rubrics->sortBy('score_level') as $rubric)
                                        <div class="grid grid-cols-[40px_minmax(0,1fr)] items-center gap-3 p-4 transition hover:bg-emerald-50/30">

                                            <div class="flex items-center justify-center">
                                                <span
                                                    class="flex h-10 w-10 items-center justify-center
                                                           rounded-xl border border-emerald-100
                                                           bg-emerald-50 text-base font-bold
                                                           text-emerald-800">
                                                    {{ $rubric->score_level }}
                                                </span>
                                            </div>

                                            <div class="min-w-0 self-center">
                                                <p class="m-0 whitespace-pre-line break-words text-sm leading-6 text-slate-700">{{ trim(preg_replace('/^[ \t]+|[ \t]+$/m', '', $rubric->description ?? '')) }}</p>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </details>
@endforeach
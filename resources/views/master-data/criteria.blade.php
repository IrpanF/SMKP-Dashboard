
@foreach ($criteriaItems as $criteria)
    <details class="group mt-2">
        <summary
            class="flex cursor-pointer list-none items-center gap-3
                   rounded-xl border border-slate-200 bg-white
                   px-4 py-3 transition
                   hover:border-emerald-300 hover:bg-emerald-50/40">

            <svg
                class="h-4 w-4 shrink-0 text-slate-400 transition
                       group-open:rotate-90"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m9 5 7 7-7 7" />
            </svg>

            <span class="shrink-0 rounded-md bg-emerald-50
                         px-2 py-1 text-xs font-bold text-emerald-700">
                {{ $criteria->code }}
            </span>

            <span class="flex-1 text-sm font-medium text-slate-700">
                {{ $criteria->name }}
            </span>

            @if ($criteria->children->isNotEmpty())
                <span class="text-xs text-slate-400">
                    {{ $criteria->children->count() }} subkriteria
                </span>
            @elseif ($criteria->indicators->isNotEmpty())
                <span class="text-xs text-slate-400">
                    {{ $criteria->indicators->count() }} indikator
                </span>
            @endif
        </summary>

        <div class="ml-4 border-l-2 border-emerald-100
                    py-2 pl-3 sm:ml-6 sm:pl-4">

            {{-- SUBKRITERIA --}}
            @if ($criteria->children->isNotEmpty())
                @include('master-data.criteria', [
                    'criteriaItems' => $criteria->children
                ])
            @endif

            {{-- INDIKATOR --}}
            @if ($criteria->indicators->isNotEmpty())
                <div class="mt-2 rounded-xl bg-slate-50 p-4">
                    <p class="mb-3 text-xs font-bold uppercase
                              tracking-wide text-slate-500">
                        Indikator Penilaian
                    </p>

                    <ol class="space-y-3">
                        @foreach ($criteria->indicators->sortBy('sort_order') as $index => $indicator)
                            <li class="flex items-start gap-3 text-sm
                                       leading-relaxed text-slate-600">

                                <span class="flex h-6 w-6 shrink-0
                                             items-center justify-center
                                             rounded-full bg-white
                                             text-xs font-semibold
                                             text-emerald-700 ring-1
                                             ring-slate-200">
                                    {{ $index + 1 }}
                                </span>

                                <span class="whitespace-pre-line">
                                    {{ $indicator->indicator }}
                                </span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            @endif

        </div>
    </details>
@endforeach

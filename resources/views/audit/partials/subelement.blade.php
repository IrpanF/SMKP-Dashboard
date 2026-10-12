<div class="rounded-xl border border-slate-200 bg-white p-4">

        @foreach ($criteriaItems as $criteria)
            <details
                class="subelement-item group overflow-hidden rounded-xl
                    border border-slate-200 bg-white">

                <summary
                    class="flex cursor-pointer list-none items-center
                        gap-3 px-3 py-3 transition hover:bg-emerald-50/50">

                    <svg class="h-4 w-4 shrink-0 text-slate-400 transition
                        group-open:rotate-90"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                    </svg>

                    <span
                        class="rounded-md bg-emerald-50 px-2 py-1
                         text-xs font-bold text-emerald-700">
                        {{ $criteria->code }}
                    </span>

                    <span class="min-w-0 flex-1 text-sm font-semibold text-slate-800">
                        {{ $criteria->name }}
                    </span>

                    @if ($criteria->indicators->isNotEmpty())
                        <span class="hidden text-xs text-slate-400 sm:inline">
                            {{ $criteria->indicators->count() }} indikator
                        </span>
                    @endif
                </summary>

                <div class="space-y-3 border-t border-slate-100 bg-slate-50/50 p-3">

                    @if ($criteria->indicators->isNotEmpty())
                        <div class="rounded-lg bg-white p-3">
                            <p
                                class="mb-2 text-xs font-bold uppercase tracking-wide
                              text-slate-500">
                                Indikator Penilaian
                            </p>

                            <ol
                                class="list-decimal space-y-2 pl-5 text-sm
                               leading-relaxed text-slate-600">
                                @foreach ($criteria->indicators->sortBy('sort_order') as $indicator)
                                    <li class="whitespace-pre-line">
                                        {{ $indicator->indicator }}
                                    </li>
                                @endforeach
                            </ol>

                            <div class="mt-4 max-w-xs">
                                <label
                                    class="mb-1 block text-xs font-semibold
                                      text-slate-600">
                                    Nilai Subelemen
                                </label>

                                <select
                                    class="audit-score w-full rounded-lg border-slate-300
                                   text-sm focus:border-emerald-500
                                   focus:ring-emerald-500"
                                    data-criteria="{{ $criteria->id }}">
                                    <option value="">Belum dinilai</option>
                                    <option value="0">0</option>
                                    <option value="1">1 — Mayor</option>
                                    <option value="2">2 — Minor</option>
                                    <option value="3">3 — Minor</option>
                                    <option value="4">4 — Praktik Terbaik</option>
                                    <option value="NA">N/A</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    @if ($criteria->children->isNotEmpty())
                        <div class="space-y-2 border-l-2 border-emerald-100 pl-3">
                            @include('audit.partials.subelement', [
                                'criteriaItems' => $criteria->children,
                            ])
                        </div>
                    @endif

                </div>
            </details>
        @endforeach

    </div>

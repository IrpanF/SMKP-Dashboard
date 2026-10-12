@foreach ($criteriaItems as $criteria)
    <details class="rounded-lg border border-slate-200"
             @if ($loop->first) open @endif>

        <summary class="flex cursor-pointer items-center gap-3
                       rounded-lg bg-slate-50 px-3 py-3
                       hover:bg-emerald-50">
            <span class="rounded-md bg-emerald-100 px-2 py-1
                         text-xs font-bold text-emerald-800">
                {{ $criteria->code }}
            </span>

            <span class="flex-1 text-sm font-semibold text-slate-700">
                {{ $criteria->name }}
            </span>
        </summary>

        <div class="space-y-3 p-3">
            {{-- Subkriteria bertingkat --}}
            @if ($criteria->children->isNotEmpty())
                @include('audit.partials.criteria', [
                    'criteriaItems' => $criteria->children
                ])
            @endif

            {{-- Indikator --}}
            @if ($criteria->indicators->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[540px] text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase
                                      tracking-wide text-slate-500">
                            <tr>
                                <th class="w-10 px-3 py-3">No.</th>
                                <th class="px-3 py-3">Indikator</th>
                                <th class="w-32 px-3 py-3">Nilai Audit</th>
                                <th class="w-36 px-3 py-3">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @foreach ($criteria->indicators->sortBy('sort_order') as $index => $indicator)
                                <tr data-indicator-row>
                                    <td class="px-3 py-3 text-slate-400">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="whitespace-pre-line px-3 py-3
                                               leading-relaxed text-slate-700">
                                        {{ $indicator->indicator }}
                                    </td>

                                    <td class="px-3 py-3">
                                        <select
                                            class="audit-score w-full rounded-lg
                                                   border-slate-300 text-sm
                                                   focus:border-emerald-500
                                                   focus:ring-emerald-500"
                                            aria-label="Nilai audit {{ $indicator->indicator }}">
                                            <option value="">Pilih nilai</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="NA">N/A</option>
                                        </select>
                                    </td>

                                    <td class="px-3 py-3">
                                        <span data-status
                                              class="inline-flex rounded-full
                                                     bg-slate-100 px-2 py-1
                                                     text-xs font-semibold
                                                     text-slate-600">
                                            Belum dinilai
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </details>
@endforeach
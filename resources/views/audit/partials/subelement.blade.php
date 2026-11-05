<div class="rounded-xl border border-slate-200 bg-white p-4">
    @foreach ($criteriaItems as $criteria)
        @php
            $savedAssessment = $savedAssessments->get($criteria->id);
            $savedScore = $savedAssessment?->is_na ? 'NA' : $savedAssessment?->score;

            $selectedScore = old('scores.' . $criteria->id, $savedScore);
            $savedNotes = old('notes.' . $criteria->id, $savedAssessment?->notes);
        @endphp

        <details data-subelement-card="{{ $criteria->id }}"
            class="subelement-item group overflow-hidden rounded-xl border border-slate-200 bg-white transition-colors duration-200">
            <summary
                class="flex cursor-pointer list-none items-center gap-3 px-3 py-3 transition hover:bg-emerald-50/50">
                <svg class="h-4 w-4 shrink-0 text-slate-400 transition group-open:rotate-90" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                </svg>

                <span class="rounded-md bg-emerald-50 px-2 py-1 text-xs font-bold text-emerald-700">
                    {{ $criteria->code }}
                </span>

                <span class="min-w-0 flex-1 text-sm font-semibold text-slate-800">
                    {{ $criteria->name }}
                </span>

                <span class="shrink-0 rounded-lg bg-emerald-50 px-2 py-1 text-xs font-semibold text-emerald-700">
                    Maks: {{ $criteria->max_score ?? 0 }}
                </span>
            </summary>

            <div class="space-y-3 border-t border-slate-100 bg-slate-50/50 p-3">
                @if ($criteria->indicators->isNotEmpty())
                    <div class="rounded-lg bg-white p-3">
                        <p class="mb-3 text-xs font-bold uppercase tracking-wide text-slate-500">
                            Daftar Indikator (Referensi)
                        </p>

                        <div class="overflow-x-auto">
                            <table class="w-full table-fixed border-collapse text-sm">
                                <colgroup>
                                    <col class="w-12">
                                    <col>
                                </colgroup>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach ($criteria->indicators->sortBy('sort_order')->values() as $index => $indicator)
                                        <tr>
                                            <td class="w-12 py-3 pr-3 align-top text-right font-medium text-slate-500">
                                                {{ $index + 1 }}.
                                            </td>
                                            <td class="py-3 align-top break-words leading-relaxed text-slate-700">
                                                {{ preg_replace('/[ \t]+/', ' ', trim(html_entity_decode($indicator->indicator, ENT_QUOTES | ENT_HTML5, 'UTF-8'))) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                @if ($criteria->children->isNotEmpty())
                    <div class="space-y-2 border-l-2 border-emerald-100 pl-3">
                        @include('audit.partials.subelement', [
                            'criteriaItems' => $criteria->children,
                        ])
                    </div>
                @elseif ($criteria->indicators->isNotEmpty())
                    <div class="max-w-xs rounded-lg bg-white p-3">
                        <label class="mb-1 block text-xs font-semibold text-slate-600">
                            Nilai Subelemen
                        </label>


                        <select name="scores[{{ $criteria->id }}]"
                            class="audit-score w-full rounded-lg border-slate-300 text-sm focus:border-emerald-500 focus:ring-emerald-500"
                            data-criteria="{{ $criteria->id }}" data-max-score="{{ $criteria->max_score ?? 0 }}"
                            data-element-id="{{ $criteria->smkp_element_id }}">

                            <option value="" @selected($selectedScore === null || $selectedScore === '')>
                                Belum dinilai
                            </option>

                            @for ($score = 0; $score <= (int) ($criteria->max_score ?? 0); $score++)
                                <option value="{{ $score }}" @selected((string) $selectedScore === (string) $score)>
                                    {{ $score }} poin
                                </option>
                            @endfor

                            <option value="NA" @selected($selectedScore === 'NA')>N/A</option>
                        </select>

                        <p data-score-note="{{ $criteria->id }}"
                            class="mt-2 hidden rounded-lg px-3 py-2 text-xs font-semibold"></p>

                        <div class="mt-3">
                            <label for="notes-{{ $criteria->id }}"
                                class="mb-1 block text-xs font-semibold text-slate-600">
                                Keterangan / Catatan Auditor
                            </label>

                            <textarea id="notes-{{ $criteria->id }}" name="notes[{{ $criteria->id }}]" rows="2" maxlength="5000"
                                placeholder="Tambahkan catatan jika diperlukan..."
                                class="w-full rounded-lg border-slate-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">{{ $savedNotes }}</textarea>
                        </div>

                    </div>
                @endif
            </div>
        </details>
    @endforeach
</div>

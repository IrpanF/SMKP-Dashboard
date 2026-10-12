<x-app-layout>
    <div class="min-h-screen bg-slate-50 p-4 sm:p-6">

        <div class="mb-6">
            <p class="text-sm font-semibold text-emerald-700">
                Audit SMKP
            </p>
            <h1 class="mt-1 text-2xl font-bold text-slate-800">
                Checklist Audit SMKP
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Sistem Manajemen Keselamatan Pertambangan
            </p>
        </div>

        {{-- RINGKASAN --}}
        <div class="mb-5 grid grid-cols-1 gap-3 sm:grid-cols-3">
            <div class="rounded-xl border border-slate-200 bg-white p-4">
                <p class="text-sm text-slate-500">Total Elemen</p>
                <p class="mt-1 text-2xl font-bold text-emerald-700">
                    {{ $elements->count() }}
                </p>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-4">
                <p class="text-sm text-slate-500">Total Subelemen Dinilai</p>
                <p id="total-subelements"
                   class="mt-1 text-2xl font-bold text-slate-800">0</p>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-4">
                <p class="text-sm text-slate-500">Sudah Dinilai</p>
                <p id="scored-subelements"
                   class="mt-1 text-2xl font-bold text-slate-800">0</p>
            </div>
        </div>

        <div class="grid grid-cols-1 items-start gap-5 lg:grid-cols-12">

            {{-- DAFTAR ELEMEN --}}
            <aside class="lg:col-span-4 lg:sticky lg:top-20 lg:self-start">
                <div class="overflow-hidden rounded-xl border
                            border-slate-200 bg-white">

                    <div class="border-b border-slate-100 p-4">
                        <h2 class="font-bold text-slate-800">
                            Daftar Elemen
                        </h2>
                        <p class="mt-1 text-xs text-slate-500">
                            Pilih elemen untuk melihat subelemen.
                        </p>
                    </div>

                    <div class="max-h-[calc(100vh-12rem)] space-y-2 overflow-y-auto p-3">
                        @forelse ($elements as $element)
                            <button
                                type="button"
                                data-element-button="{{ $element->id }}"
                                onclick="showElement('{{ $element->id }}')"
                                class="element-button flex w-full items-center
                                       gap-3 rounded-lg border border-slate-200
                                       p-3 text-left transition hover:bg-emerald-50">

                                <span class="flex h-10 w-10 shrink-0
                                             items-center justify-center
                                             rounded-lg bg-emerald-100
                                             text-sm font-bold text-emerald-800">
                                    {{ $element->code }}
                                </span>

                                <span class="min-w-0 flex-1">
                                    <span class="block text-sm font-semibold
                                                 text-slate-800">
                                        {{ $element->name }}
                                    </span>
                                    <span class="mt-1 block text-xs text-slate-500">
                                        {{ $element->criteria->count() }}
                                        kriteria utama
                                    </span>
                                </span>
                            </button>
                        @empty
                            <p class="p-5 text-center text-sm text-slate-500">
                                Data elemen belum tersedia.
                            </p>
                        @endforelse
                    </div>
                </div>
            </aside>

            {{-- DETAIL ELEMEN --}}
            <main class="lg:col-span-8">
                @foreach ($elements as $element)
                    <section
                        data-element-panel="{{ $element->id }}"
                        class="element-panel hidden">

                        <div class="mb-4 rounded-xl border
                                    border-slate-200 bg-white p-4">

                            <p class="text-xs font-semibold uppercase
                                      tracking-wide text-emerald-700">
                                Elemen {{ $element->code }}
                            </p>

                            <h2 class="mt-1 text-lg font-bold text-slate-800">
                                {{ $element->name }}
                            </h2>

                            <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2">
                                <div>
                                    <label class="mb-1 block text-xs font-semibold
                                                  text-slate-600">
                                        Bobot Elemen (%)
                                    </label>
                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        step="0.01"
                                        value="{{ $element->weight ?? 0 }}"
                                        class="element-weight w-full rounded-lg
                                               border-slate-300 text-sm
                                               focus:border-emerald-500
                                               focus:ring-emerald-500">
                                </div>

                                <div class="rounded-lg bg-emerald-50 p-3">
                                    <p class="text-xs text-emerald-700">
                                        Subelemen sudah dinilai
                                    </p>
                                    <p data-element-progress="{{ $element->id }}"
                                       class="mt-1 text-lg font-bold text-emerald-800">
                                        0
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            @include('audit.partials.subelement', [
                                'criteriaItems' => $element->criteria
                            ])
                        </div>
                    </section>
                @endforeach
            </main>
        </div>
    </div>

    <script>
        function showElement(id) {
            document.querySelectorAll('[data-element-panel]').forEach(panel => {
                panel.classList.toggle(
                    'hidden',
                    panel.dataset.elementPanel !== String(id)
                );
            });

            document.querySelectorAll('[data-element-button]').forEach(button => {
                const active = button.dataset.elementButton === String(id);

                button.classList.toggle('border-emerald-500', active);
                button.classList.toggle('bg-emerald-50', active);
                button.classList.toggle('border-slate-200', !active);
            });
        }

        function updateSummary() {
            const inputs = [...document.querySelectorAll('.audit-score')];

            document.getElementById('total-subelements').textContent =
                inputs.length;

            document.getElementById('scored-subelements').textContent =
                inputs.filter(input => input.value !== '').length;

            document.querySelectorAll('[data-element-panel]').forEach(panel => {
                const inputs = [...panel.querySelectorAll('.audit-score')];
                const scored = inputs.filter(input => input.value !== '').length;
                const progress = panel.querySelector('[data-element-progress]');

                if (progress) {
                    progress.textContent = `${scored} / ${inputs.length}`;
                }
            });
        }

        document.querySelectorAll('.audit-score').forEach(input => {
            input.addEventListener('change', updateSummary);
        });

        const firstButton = document.querySelector('[data-element-button]');

        if (firstButton) {
            showElement(firstButton.dataset.elementButton);
        }

        updateSummary();
    </script>
</x-app-layout>
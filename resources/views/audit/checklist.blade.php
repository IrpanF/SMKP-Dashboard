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

        <div
            class="mb-4 flex flex-col gap-3 rounded-xl border border-emerald-200 bg-white p-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">
                    Audit yang sedang dibuka
                </p>
                <h2 class="mt-1 text-lg font-bold text-slate-800">
                    {{ $audit->title }}
                </h2>

                <p class="mt-2 flex flex-wrap items-center gap-x-2 gap-y-1 text-sm text-slate-500">
                    <span>
                        Site:
                        <span class="font-semibold text-slate-700">
                            {{ $audit->site ? $audit->site->company_name . ' - Site ' . $audit->site->site_name : 'Belum ditentukan' }}
                        </span>
                    </span>
                </p>
                <p class="mt-2 flex flex-wrap items-center gap-x-2 gap-y-1 text-sm text-slate-500">
                    <span>
                        Periode Audit:
                        <span class="font-semibold text-slate-700">
                            {{ $audit->audit_start_date?->format('d/m/Y') ?? '-' }}
                            <span class="mx-1 text-slate-400">s.d.</span>
                            {{ $audit->audit_end_date?->format('d/m/Y') ?? '-' }}
                        </span>
                    </span>

                    <span class="hidden sm:inline">·</span>

                    <span class="font-medium text-amber-600">
                        Status: Draft
                    </span>
                </p>
            </div>

            <a href="{{ route('audit.index') }}"
                class="inline-flex justify-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">
                Kembali ke Daftar Audit
            </a>
        </div>

        @if (session('success'))
            <div
                class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif


        <form method="POST" action="{{ route('audit.save', $audit) }}">
            @csrf

            {{-- RINGKASAN AUDIT --}}
            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

                {{-- PROGRES PENILAIAN --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-emerald-100 bg-gradient-to-br from-white to-emerald-50 p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">
                    <div class="absolute -left-5 -top-5 h-24 w-24 rounded-full bg-emerald-100/60"></div>

                    <div class="relative flex items-start justify-between gap-3">
                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Progres Penilaian
                            </p>

                            <p
                                class="mt-3 flex items-baseline gap-2 text-2xl font-bold tracking-tight text-emerald-800">
                                <span id="scored-subelements">0</span>
                                <span class="text-base font-medium text-slate-400">/</span>
                                <span id="total-subelements">0</span>
                            </p>

                            <p class="mt-2 text-xs text-emerald-700">
                                Subelemen sudah dinilai
                            </p>
                        </div>

                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M7.5 3.75h9A2.25 2.25 0 0 1 18.75 6v12A2.25 2.25 0 0 1 16.5 20.25h-9A2.25 2.25 0 0 1 5.25 18V6A2.25 2.25 0 0 1 7.5 3.75Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- TOTAL POIN --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-blue-100 bg-gradient-to-br from-white to-blue-50 p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">
                    <div class="absolute -left-5 -top-5 h-24 w-24 rounded-full bg-blue-100/60"></div>

                    <div class="relative flex items-start justify-between gap-3">
                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Total Poin
                            </p>

                            <p id="earned-points" class="mt-3 text-2xl font-bold tracking-tight text-blue-800">
                                0 / 339
                            </p>

                            <p class="mt-2 text-xs text-blue-700">
                                Poin diperoleh dari penilaian
                            </p>
                        </div>

                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-700 shadow-sm">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 5.25H6.75A2.25 2.25 0 0 0 4.5 7.5v12A2.25 2.25 0 0 0 6.75 21.75h10.5A2.25 2.25 0 0 0 19.5 19.5v-12a2.25 2.25 0 0 0-2.25-2.25H15" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 3.75h6v3H9zM8 12h8M8 15.5h8M8 9h2" />
                            </svg>

                        </div>
                    </div>
                </div>

                {{-- PERSENTASE NILAI --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-violet-100 bg-gradient-to-br from-white to-violet-50 p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">
                    <div class="absolute -left-5 -top-5 h-24 w-24 rounded-full bg-violet-100/60"></div>

                    <div class="relative flex items-start justify-between gap-3">
                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Persentase Nilai
                            </p>

                            <p id="audit-percentage" class="mt-3 text-2xl font-bold tracking-tight text-violet-800">
                                0%
                            </p>

                            <p class="mt-2 text-xs text-violet-700">
                                Hasil berdasarkan bobot elemen
                            </p>
                        </div>

                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-violet-100 text-violet-700 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 19.5h15M6.75 16.5v-5.25m5.25 5.25V6.75m5.25 9.75v-3.75" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m5.25 8.25 5.25-3 4.5 3 4.5-4.5" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- PATOKAN AUDIT --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-amber-100 bg-gradient-to-br from-white to-amber-50 p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">
                    <div class="absolute -left-5 -top-5 h-24 w-24 rounded-full bg-amber-100/60"></div>

                    <div class="relative flex items-start justify-between gap-3">
                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Patokan Audit
                            </p>

                            <p class="mt-3 text-2xl font-bold tracking-tight text-amber-800">
                                339 Poin
                            </p>

                            <p class="mt-2 text-xs text-amber-700">
                                Bobot keseluruhan: 100%
                            </p>
                        </div>

                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-700 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 3.75h7.5l3 3v13.5H5.25V3.75h3Zm0 0v4.5h7.5v-4.5M8.25 12h7.5M8.25 15.75h7.5" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 items-start gap-5 lg:grid-cols-12">

                {{-- DAFTAR ELEMEN --}}
                <aside class="lg:col-span-4 lg:sticky lg:top-20 lg:self-start">
                    <div
                        class="overflow-hidden rounded-xl border
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
                                <button type="button" data-element-button="{{ $element->id }}"
                                    onclick="showElement('{{ $element->id }}')"
                                    class="element-button flex w-full items-center
                                       gap-3 rounded-lg border border-slate-200
                                       p-3 text-left transition hover:bg-emerald-50">

                                    <span
                                        class="flex h-10 w-10 shrink-0
                                             items-center justify-center
                                             rounded-lg bg-emerald-100
                                             text-sm font-bold text-emerald-800">
                                        {{ $element->code }}
                                    </span>

                                    <span class="min-w-0 flex-1">
                                        <span
                                            class="block text-sm font-semibold
                                                 text-slate-800">
                                            {{ $element->name }}
                                        </span>
                                        <span class="mt-1 block text-xs text-slate-500">
                                            {{ $element->criteria->count() }} kriteria utama
                                        </span>

                                        <span
                                            class="mt-1 inline-flex rounded-md bg-emerald-50 px-2 py-1 text-xs font-semibold text-emerald-700">
                                            Bobot:
                                            <span class="ml-1" data-element-weight-label="{{ $element->id }}">
                                                {{ number_format((float) ($element->weight ?? 0), 2) }}%
                                            </span>
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
                        <section data-element-panel="{{ $element->id }}"
                            data-element-weight="{{ $element->weight ?? 0 }}" class="element-panel hidden">

                            <div
                                class="mb-4 rounded-xl border
                                    border-slate-200 bg-white p-4">

                                <p
                                    class="text-xs font-semibold uppercase
                                      tracking-wide text-emerald-700">
                                    Elemen {{ $element->code }}
                                </p>

                                <h2 class="mt-1 text-lg font-bold text-slate-800">
                                    {{ $element->name }}
                                </h2>

                                <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-3">

                                    {{-- POIN ELEMEN --}}
                                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                                        <p class="text-xs font-semibold text-slate-600">
                                            Poin Elemen
                                        </p>

                                        <p data-element-points="{{ $element->id }}"
                                            class="mt-2 text-xl font-bold text-slate-800">
                                            0 / {{ $element->criteria->sum('max_score') }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Poin diperoleh / maksimal
                                        </p>
                                    </div>

                                    {{-- PROGRES PENILAIAN --}}
                                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                                        <p class="text-xs font-semibold text-slate-600">
                                            Subelemen Dinilai
                                        </p>

                                        <p data-element-progress="{{ $element->id }}"
                                            class="mt-2 text-xl font-bold text-slate-800">
                                            0 / 0
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Sudah dinilai
                                        </p>
                                    </div>

                                    {{-- NILAI ELEMEN --}}
                                    <div class="rounded-xl border border-emerald-100 bg-emerald-50 p-3">
                                        <p class="text-xs font-semibold text-emerald-700">
                                            Nilai Elemen
                                        </p>

                                        <p data-element-score="{{ $element->id }}"
                                            class="mt-2 text-xl font-bold text-emerald-800">
                                            0,00 / {{ number_format((float) ($element->weight ?? 0), 2, ',', '.') }}%
                                        </p>

                                        <p class="mt-1 text-xs text-emerald-700">
                                            Kontribusi:
                                            <span data-element-contribution="{{ $element->id }}">0,00%</span>
                                        </p>
                                    </div>

                                </div>

                            </div>

                            <div class="space-y-3">
                                @include('audit.partials.subelement', [
                                    'criteriaItems' => $element->criteria,
                                ])
                            </div>
                        </section>
                    @endforeach
                </main>
            </div>
    </div>

    {{-- AKSI AUDIT --}}
    <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="flex flex-col gap-4 p-5 sm:p-6 lg:flex-row lg:items-center lg:justify-between">

            {{-- KETERANGAN --}}
            <div class="flex items-start gap-3">
                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M7.5 3.75h9A2.25 2.25 0 0 1 18.75 6v12A2.25 2.25 0 0 1 16.5 20.25h-9A2.25 2.25 0 0 1 5.25 18V6A2.25 2.25 0 0 1 7.5 3.75Z" />
                    </svg>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-slate-800">
                        Simpan progres audit
                    </h3>
                    <p class="mt-1 max-w-xl text-sm leading-relaxed text-slate-500">
                        Simpan penilaian sementara dan lanjutkan kembali nanti.
                        Pastikan seluruh subelemen sudah dinilai sebelum menyelesaikan audit.
                    </p>
                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="flex w-full flex-col gap-3 sm:flex-row lg:w-auto">

                {{-- SIMPAN DRAFT --}}
                <button type="submit"
                    class="inline-flex min-h-12 items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-white px-5 py-3 text-sm font-bold text-emerald-700 shadow-sm transition duration-200 hover:border-emerald-300 hover:bg-emerald-50 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-emerald-100 active:scale-[0.98]">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.25 4.5h11.379a2.25 2.25 0 0 1 1.591.659l1.121 1.121A2.25 2.25 0 0 1 20 7.871V19.5H4V5.75A1.25 1.25 0 0 1 5.25 4.5Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 4.5v5h8v-5M8 19.5v-6h8v6" />
                    </svg>

                    Simpan Draft
                </button>

                {{-- SELESAIKAN AUDIT --}}
                <button type="submit" form="complete-audit-form"
                    class="inline-flex min-h-12 items-center justify-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-sm transition duration-200 hover:bg-emerald-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-emerald-200 active:scale-[0.98]"
                    onclick="return confirm('Apakah kamu yakin ingin menyelesaikan audit ini? Setelah selesai, penilaian tidak dapat diubah lagi.')">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m5 12.75 4.5 4.5L19 7.5" />
                    </svg>

                    Selesaikan Audit
                </button>

            </div>
        </div>
    </div>
    </form>

    <form id="complete-audit-form" method="POST" action="{{ route('audit.complete', $audit) }}">
        @csrf
    </form>

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


        function updateScoreNotes() {
            document.querySelectorAll('.audit-score').forEach(input => {
                const id = input.dataset.criteria;

                const note = document.querySelector(
                    `[data-score-note="${id}"]`
                );

                const card = document.querySelector(
                    `[data-subelement-card="${id}"]`
                );

                if (!note || !card) return;

                const summary = card.querySelector(':scope > summary');
                const content = summary?.nextElementSibling;

                // Reset keterangan
                note.classList.add('hidden');
                note.textContent = '';
                note.className =
                    'mt-2 hidden rounded-lg px-3 py-2 text-xs font-semibold';

                // Reset warna card dan bagian dalamnya
                card.style.backgroundColor = '';
                card.style.borderColor = '';

                if (summary) summary.style.backgroundColor = '';
                if (content) content.style.backgroundColor = '';

                if (input.value === '' || input.value === 'NA') {
                    return;
                }

                const score = Number(input.value);
                const max = Number(input.dataset.maxScore || 0);

                let label;
                let background;
                let border;
                let noteClasses;


                if (score === max) {
                    label = 'Praktik Terbaik';
                    background = '#ECFDF5'; // Hijau pastel lembut
                    border = '#A7DCC2';
                    noteClasses = 'bg-emerald-50 text-emerald-700';
                } else if (score >= 2) {
                    label = 'Minor';
                    background = '#FFFBEB'; // Kuning pastel lembut
                    border = '#F3D98B';
                    noteClasses = 'bg-amber-50 text-amber-700';
                } else {
                    label = 'Mayor';
                    background = '#FEF2F2'; // Merah pastel lembut
                    border = '#F2B8B8';
                    noteClasses = 'bg-red-50 text-red-700';
                }

                // Terapkan warna ke card, header, dan area isi
                card.style.backgroundColor = background;
                card.style.borderColor = border;

                if (summary) summary.style.backgroundColor = background;
                if (content) content.style.backgroundColor = background;

                note.textContent = `Keterangan: ${label}`;
                note.classList.add(...noteClasses.split(' '));
                note.classList.remove('hidden');
            });
        }

        function updateSummary() {
            const inputs = [...document.querySelectorAll('.audit-score')];

            const scored = inputs.filter(input => input.value !== '');

            const applicable = inputs.filter(input => input.value !== 'NA');

            const earned = applicable.reduce((total, input) => {
                return total + (input.value === '' ? 0 : Number(input.value));
            }, 0);

            const maxApplicable = applicable.reduce((total, input) => {
                return total + Number(input.dataset.maxScore || 0);
            }, 0);

            let finalPercentage = 0;

            document.querySelectorAll('[data-element-panel]').forEach(panel => {
                const elementInputs = [...panel.querySelectorAll('.audit-score')];

                const elementApplicable = elementInputs.filter(
                    input => input.value !== 'NA'
                );

                const elementEarned = elementApplicable.reduce((total, input) => {
                    return total + (input.value === '' ? 0 : Number(input.value));
                }, 0);

                const elementMax = elementApplicable.reduce((total, input) => {
                    return total + Number(input.dataset.maxScore || 0);
                }, 0);

                // Bobot diambil dari database melalui atribut section.
                const weight = Number(panel.dataset.elementWeight || 0);

                // Persentase pencapaian elemen, maksimal 100%
                const elementPercentage = elementMax > 0 ?
                    (elementEarned / elementMax) * 100 :
                    0;

                // Nilai elemen disesuaikan dengan bobotnya
                const contribution = (elementPercentage * weight) / 100;

                finalPercentage += contribution;

                const elementId = panel.dataset.elementPanel;

                const scoreLabel = document.querySelector(
                    `[data-element-score="${elementId}"]`
                );

                const contributionLabel = document.querySelector(
                    `[data-element-contribution="${elementId}"]`
                );

                const pointsLabel = document.querySelector(
                    `[data-element-points="${elementId}"]`
                );

                const progress = panel.querySelector('[data-element-progress]');

                const elementScored = elementInputs.filter(
                    input => input.value !== ''
                ).length;

                if (scoreLabel) {
                    scoreLabel.textContent =
                        `${contribution.toFixed(2).replace('.', ',')} / ${weight.toFixed(2).replace('.', ',')}%`;
                }

                if (contributionLabel) {
                    contributionLabel.textContent =
                        `${contribution.toFixed(2).replace('.', ',')}%`;
                }

                if (pointsLabel) {
                    pointsLabel.textContent = `${elementEarned} / ${elementMax}`;
                }

                if (progress) {
                    progress.textContent =
                        `${elementScored} / ${elementInputs.length}`;
                }
            });

            document.getElementById('total-subelements').textContent = inputs.length;
            document.getElementById('scored-subelements').textContent = scored.length;

            document.getElementById('earned-points').textContent =
                `${earned} / ${maxApplicable}`;

            document.getElementById('audit-percentage').textContent =
                `${finalPercentage.toFixed(2).replace('.', ',')}%`;
        }

        document.querySelectorAll('.audit-score').forEach(input => {
            input.addEventListener('change', () => {
                updateScoreNotes();
                updateSummary();
            });
        });

        const firstButton = document.querySelector('[data-element-button]');

        if (firstButton) {
            showElement(firstButton.dataset.elementButton);
        }

        updateScoreNotes();
        updateSummary();
    </script>
</x-app-layout>

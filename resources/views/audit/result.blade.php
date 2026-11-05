<x-app-layout>
    <div class="min-h-screen w-full bg-slate-50 p-4 sm:p-6">
        <div class="w-full">

            {{-- HEADER --}}
            <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">
                        Audit SMKP
                    </p>
                    <h1 class="mt-1 text-2xl font-extrabold text-slate-800 sm:text-3xl">
                        Hasil Audit
                    </h1>
                    <p class="mt-2 text-sm text-slate-500">
                        Ringkasan nilai dan rincian penilaian berdasarkan elemen SMKP.
                    </p>
                </div>

                <a href="{{ route('audit.index') }}"
                    class="inline-flex h-10 items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </div>

            {{-- INFORMASI AUDIT --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-emerald-100 bg-white shadow-sm">
                <div class="bg-gradient-to-r from-emerald-700 to-emerald-500 px-5 py-5 text-white sm:px-7">
                    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                        <div>
                            <p class="text-sm font-medium text-emerald-50">
                                Audit telah diselesaikan
                            </p>
                            <h2 class="mt-1 text-xl font-bold sm:text-2xl">
                                {{ $audit->title }}
                            </h2>
                            <p class="mt-2 text-sm text-emerald-50">
                                Site:
                                <span class="font-semibold text-white">
                                    {{ $audit->site ? $audit->site->company_name . ' - Site ' . $audit->site->site_name : 'Belum ditentukan' }}
                                </span>
                            </p>
                            <p class="mt-2 text-sm text-emerald-50">
                                Periode audit:
                                <span class="font-semibold text-white">
                                    {{ $audit->audit_start_date?->format('d/m/Y') ?? '-' }}
                                    <span class="mx-1 text-emerald-200">s.d.</span>
                                    {{ $audit->audit_end_date?->format('d/m/Y') ?? '-' }}
                                </span>
                            </p>
                        </div>

                        <div
                            class="inline-flex w-fit items-center gap-2 rounded-xl bg-white/15 px-4 py-3 text-sm font-bold ring-1 ring-white/20">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.042-.133-2.053-.382-3.016z" />
                            </svg>
                            Selesai
                        </div>
                    </div>
                </div>

                <div class="flex flex-col justify-between gap-3 px-5 py-4 sm:flex-row sm:items-center sm:px-7">
                    <p class="text-sm text-slate-500">
                        Diselesaikan pada
                        <span class="font-semibold text-slate-700">
                            {{ $audit->completed_at?->format('d/m/Y H:i') ?? '-' }}
                        </span>
                    </p>

                    <form action="{{ route('audit.revise', $audit) }}" method="POST"
                        onsubmit="return confirm('Mulai revisi penilaian audit ini? Status akan berubah menjadi Draft.');">
                        @csrf
                        <button type="submit"
                            class="inline-flex h-10 items-center justify-center gap-2 rounded-xl bg-amber-50 px-4 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            Revisi Penilaian
                        </button>
                    </form>
                </div>
            </div>

            {{-- RINGKASAN --}}
            <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

                <div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Total Poin</p>
                        <span class="rounded-xl bg-emerald-50 p-2 text-emerald-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                            </svg>
                        </span>
                    </div>
                    <p class="mt-3 text-3xl font-extrabold text-slate-800">
                        {{ $totalPoints }}
                        <span class="text-base font-semibold text-slate-400">
                            / {{ $adjustedMaxPoints }}
                        </span>
                    </p>
                    <div class="mt-4 h-2 overflow-hidden rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-emerald-500"
                            style="width: {{ min(100, max(0, $overallPercentage)) }}%">
                        </div>
                    </div>
                    <p class="mt-2 text-sm font-semibold text-emerald-700">
                        {{ $overallPercentage }}% dari {{ $adjustedMaxPoints }} poin
                    </p>
                </div>

                <div class="rounded-2xl border border-blue-100 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Persentase Capaian</p>
                    <p class="mt-3 text-3xl font-extrabold text-blue-700">
                        {{ $overallPercentage }}%
                    </p>
                    <p class="mt-2 text-sm text-slate-500">
                        Berdasarkan poin maksimal setelah penyesuaian N/A
                    </p>
                </div>

                <div class="rounded-2xl border border-violet-100 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Subelemen Dinilai</p>
                    <p class="mt-3 text-3xl font-extrabold text-violet-700">
                        {{ $scoredAssessments->count() }}
                    </p>
                    <p class="mt-2 text-sm text-slate-500">
                        Termasuk penilaian N/A
                    </p>
                </div>

                <div class="rounded-2xl border border-amber-100 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Elemen SMKP</p>
                    <p class="mt-3 text-3xl font-extrabold text-amber-700">
                        {{ $elementResults->count() }}
                    </p>
                    <p class="mt-2 text-sm text-slate-500">
                        Elemen dalam daftar penilaian
                    </p>
                </div>
            </div>

            {{-- HASIL PER ELEMEN --}}
            <div class="mb-4">
                <h2 class="text-xl font-extrabold text-slate-800">
                    Hasil Penilaian per Elemen
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Pilih elemen untuk melihat rincian nilai dan catatan setiap subelemen.
                </p>
            </div>


            <div class="space-y-5">
                @forelse ($elementResults as $result)
                    <details class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
                        {{ $loop->first ? 'open' : '' }}>

                        <summary class="cursor-pointer list-none px-5 py-5 transition hover:bg-slate-50 sm:px-6">
                            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                                <div class="flex items-start gap-3">
                                    <span
                                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-lg font-extrabold text-emerald-700">
                                        {{ $loop->iteration }}
                                    </span>
                                    <div>
                                        <h3 class="font-bold text-slate-800">
                                            {{ $result->element->name }}
                                        </h3>
                                        <p class="mt-1 text-sm text-slate-500">
                                            {{ $result->scored_count }} subelemen dinilai
                                        </p>
                                    </div>
                                </div>
                                @php
                                    $bobotElemen = [10, 15, 17, 35, 15, 3, 5][$loop->index] ?? 0;

                                    $nilaiElemen =
                                        $result->max_points > 0
                                            ? ($result->points / $result->max_points) * $bobotElemen
                                            : 0;

                                    $nilaiElemen = min($bobotElemen, $nilaiElemen);
                                @endphp
                                <div class="flex items-center gap-4 lg:min-w-80">
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center justify-between gap-3 text-sm">
                                            <span class="font-semibold text-slate-700">
                                                {{ $result->points }} / {{ $result->max_points }} poin
                                            </span>
                                            <span class="font-bold text-emerald-700">
                                                {{ number_format($nilaiElemen, 2, ',', '.') }}%
                                            </span>
                                        </div>
                                        <div class="mt-2 h-2.5 overflow-hidden rounded-full bg-slate-100">
                                            <div class="h-full rounded-full bg-emerald-500 transition-all"
                                                style="width: {{ $result->percentage }}%">
                                            </div>
                                        </div>

                                        <div class="mt-3 rounded-xl bg-slate-50 px-3 py-3">
                                            <div
                                                class="flex flex-wrap items-center justify-between gap-x-4 gap-y-2 text-xs">
                                                <span class="text-slate-500">
                                                    Bobot elemen:
                                                    <span
                                                        class="font-semibold text-slate-700">{{ $bobotElemen }}%</span>
                                                </span>

                                                <span class="font-semibold text-blue-700">
                                                    Nilai:
                                                    {{ number_format($nilaiElemen, 2, ',', '.') }}
                                                    / {{ number_format($bobotElemen, 2, ',', '.') }}%
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <svg class="h-5 w-5 shrink-0 text-slate-400 transition-transform group-open:rotate-180"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </summary>

                        <div class="border-t border-slate-100">
                            @if ($result->assessments->isNotEmpty())
                                <div class="overflow-x-auto flex justify-center">
                                    <table class="w-full min-w-[1000px] table-fixed divide-y divide-slate-200 text-sm">
                                        <thead class="bg-slate-50">
                                            <tr>
                                                <th class="w-[60%] px-6 py-4 text-left font-semibold text-slate-600">
                                                    Kode / Subelemen
                                                </th>
                                                <th class="w-[10%] px-5 py-4 text-center font-semibold text-slate-600">
                                                    Nilai
                                                </th>
                                                <th class="w-[15%] px-5 py-4 text-center font-semibold text-slate-600">
                                                    Hasil
                                                </th>
                                                <th class="w-[15%] px-6 py-4 text-center font-semibold text-slate-600">
                                                    Catatan Auditor
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100">
                                            @foreach ($result->assessments as $assessment)
                                                <tr class="align-top transition hover:bg-slate-50/70">
                                                    <td class="px-5 py-4 sm:px-6">
                                                        <p class="font-bold text-slate-800">
                                                            {{ $assessment->criteria?->code ?? '-' }}
                                                        </p>
                                                        <p class="mt-1 max-w-xl text-slate-600">
                                                            {{ $assessment->criteria?->name ?? 'Kriteria tidak tersedia' }}
                                                        </p>
                                                    </td>

                                                    <td class="whitespace-nowrap px-5 py-4 text-center">
                                                        @if ($assessment->is_na)
                                                            <span
                                                                class="inline-flex rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-bold text-slate-600">
                                                                N/A
                                                            </span>
                                                        @elseif ($assessment->score !== null)
                                                            <span
                                                                class="inline-flex rounded-lg bg-emerald-50 px-3 py-1.5 font-bold text-emerald-700">
                                                                {{ $assessment->score }}
                                                            </span>
                                                        @else
                                                            <span
                                                                class="inline-flex rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700">
                                                                Belum dinilai
                                                            </span>
                                                        @endif
                                                    </td>

                                                    <td class="whitespace-nowrap px-5 py-4 text-center">
                                                        @php
                                                            $skor =
                                                                $assessment->score !== null
                                                                    ? (int) $assessment->score
                                                                    : null;

                                                            $skorMaksimal =
                                                                $assessment->criteria?->max_score !== null
                                                                    ? (int) $assessment->criteria->max_score
                                                                    : null;

                                                            if ($assessment->is_na) {
                                                                $hasil = 'N/A';
                                                                $warnaHasil = 'bg-slate-100 text-slate-600';
                                                            } elseif ($skor === null || $skorMaksimal === null) {
                                                                $hasil = 'Belum ditentukan';
                                                                $warnaHasil = 'bg-slate-100 text-slate-600';
                                                            } elseif ($skor === $skorMaksimal) {
                                                                $hasil = 'Praktik Terbaik';
                                                                $warnaHasil = 'bg-emerald-50 text-emerald-700';
                                                            } elseif (
                                                                ($skorMaksimal === 4 && $skor >= 2 && $skor <= 3) ||
                                                                ($skorMaksimal === 3 && $skor === 2)
                                                            ) {
                                                                $hasil = 'Minor';
                                                                $warnaHasil = 'bg-amber-50 text-amber-700';
                                                            } elseif (
                                                                ($skorMaksimal === 4 && $skor <= 1) ||
                                                                ($skorMaksimal === 3 && $skor <= 1) ||
                                                                ($skorMaksimal === 2 && $skor < 2) ||
                                                                ($skorMaksimal === 1 && $skor === 0)
                                                            ) {
                                                                $hasil = 'Mayor';
                                                                $warnaHasil = 'bg-red-50 text-red-700';
                                                            } else {
                                                                $hasil = 'Belum ditentukan';
                                                                $warnaHasil = 'bg-slate-100 text-slate-600';
                                                            }
                                                        @endphp

                                                        <span
                                                            class="inline-flex rounded-lg px-3 py-1.5 text-xs font-semibold {{ $warnaHasil }}">
                                                            {{ $hasil }}
                                                        </span>
                                                        <p class="mt-1 text-xs text-slate-400">
                                                            Skor: {{ $assessment->score ?? '-' }}
                                                            dari {{ $assessment->criteria?->max_score ?? '-' }} poin
                                                        </p>
                                                    </td>

                                                    <td
                                                        class="whitespace-normal break-words px-5 py-4 text-center leading-relaxed text-slate-600">
                                                        {{ $assessment->notes ?: '-' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="px-6 py-8 text-center text-sm text-slate-500">
                                    Belum ada rincian penilaian untuk elemen ini.
                                </div>
                            @endif
                        </div>
                    </details>
                @empty
                    <div class="rounded-2xl border border-slate-200 bg-white px-6 py-12 text-center">
                        <p class="font-semibold text-slate-700">
                            Belum ada elemen SMKP.
                        </p>
                    </div>
                @endforelse
            </div>

            <p class="mt-5 text-xs leading-relaxed text-slate-400">
                Catatan: persentase keseluruhan dihitung berdasarkan poin maksimal
                setelah dikurangi subelemen N/A. Persentase per elemen juga
                menyesuaikan poin maksimal subelemen N/A pada elemen tersebut.
            </p>

        </div>
    </div>
</x-app-layout>

@section('title', 'SMKP UTSG - Dashboard')

<x-app-layout>
    {{-- CONTENT --}}
    <div class="py-6 bg-slate-50 min-h-[calc(100vh-65px)]">

        <div class="min-h-screen w-full bg-slate-50 p-4 sm:p-6">
            <div class="w-full">

                {{-- WELCOME --}}
                <div
                    class="relative overflow-hidden
                        bg-gradient-to-r from-emerald-700 to-emerald-500
                        rounded-2xl shadow-sm
                        px-6 py-5 mb-5">

                    {{-- Decorative --}}
                    <div
                        class="absolute -right-10 -top-16
                            w-48 h-48 rounded-full
                            bg-white/10">
                    </div>

                    <div
                        class="absolute right-24 -bottom-20
                            w-40 h-40 rounded-full
                            bg-white/5">
                    </div>

                    <div class="relative z-10">
                        <p class="text-emerald-100 text-sm">
                            Selamat datang kembali 👋
                        </p>

                        <h1 class="text-2xl font-bold text-white mt-1">
                            {{ Auth::user()->name }}
                        </h1>

                        <p class="text-sm text-emerald-50 mt-1">
                            Pantau dan kelola keselamatan pertambangan
                            melalui satu sistem terintegrasi.
                        </p>
                    </div>
                </div>

                {{-- STAT CARDS --}}
                <div class="grid grid-cols-2 gap-4 mb-5 lg:grid-cols-4">

                    {{-- Total Audit --}}
                    <div
                        class="rounded-2xl border border-emerald-100 bg-emerald-50/80 p-5 shadow-sm transition duration-200 hover:shadow-md">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="text-sm font-medium text-emerald-700">
                                    Total Audit
                                </p>

                                <p class="mt-2 text-3xl font-bold text-emerald-950">
                                    {{ $totalAudits }}
                                </p>

                                <p class="mt-1 text-xs text-emerald-700">
                                    {{ $completedAudits }} audit selesai
                                </p>
                            </div>

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 016 0M9 5h6" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Total Temuan --}}
                    <div
                        class="rounded-2xl border border-rose-100 bg-rose-50/80 p-5 shadow-sm transition duration-200 hover:shadow-md">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="text-sm font-medium text-rose-700">
                                    Total Temuan
                                </p>

                                <p class="mt-2 text-3xl font-bold text-rose-950">
                                    {{ $totalFindings }}
                                </p>

                                <p class="mt-1 text-xs text-rose-700">
                                    Temuan audit tercatat
                                </p>
                            </div>

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-rose-100 text-rose-700">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v4m0 4h.01M10.29 3.86l-8.18 14A2 2 0 003.84 21h16.32a2 2 0 001.73-3.14l-8.18-14a2 2 0 00-3.42 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Temuan Terbuka --}}
                    <div
                        class="rounded-2xl border border-amber-100 bg-amber-50/80 p-5 shadow-sm transition duration-200 hover:shadow-md">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="text-sm font-medium text-amber-800">
                                    Temuan Terbuka
                                </p>

                                <p class="mt-2 text-3xl font-bold text-amber-950">
                                    {{ $openFindings }}
                                </p>

                                <p class="mt-1 text-xs text-amber-800">
                                    Belum diverifikasi
                                </p>
                            </div>

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-700">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Nilai SMKP --}}
                    <div
                        class="rounded-2xl border border-blue-100 bg-blue-50/80 p-5 shadow-sm transition duration-200 hover:shadow-md">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="text-sm font-medium text-blue-700">
                                    Nilai SMKP
                                </p>

                                <p class="mt-2 text-3xl font-bold text-blue-950">
                                    {{ number_format($overallPercentage, 1, ',', '.') }}%
                                </p>

                                <p class="mt-1 text-xs text-blue-700">
                                    {{ $dashboardAudit ? 'Audit selesai terbaru' : 'Belum ada hasil audit' }}
                                </p>
                            </div>

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-700">
                                {{-- Ikon grafik batang --}}
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3v18h18M8 16V9m4 7V5m4 11v-4m4 4V7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>


                {{-- HASIL AUDIT SMKP --}}
                <div class="mt-5 bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                        <div>
                            <h3 class="font-bold text-slate-800">Hasil Audit SMKP</h3>

                            <p class="text-xs text-slate-500 mt-1">
                                Pilih audit untuk melihat nilai, grafik, dan rincian hasilnya.
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-2">
                            {{-- PILIH AUDIT --}}
                            <form action="{{ route('dashboard') }}" method="GET" class="w-full sm:w-auto">
                                <select name="audit_id" onchange="this.form.submit()"
                                    class="w-full sm:w-[420px] rounded-xl border border-emerald-300
               bg-white px-4 py-3 text-sm text-slate-700
               shadow-sm transition
               hover:border-emerald-500
               focus:border-emerald-600 focus:outline-none
               focus:ring-4 focus:ring-emerald-100"
                                    {{ $availableAudits->isEmpty() ? 'disabled' : '' }}>

                                    @forelse ($availableAudits as $auditOption)
                                        <option value="{{ $auditOption->id }}" @selected($dashboardAudit && $dashboardAudit->id === $auditOption->id)>
                                            {{ $auditOption->title }}
                                            — {{ $auditOption->audit_date?->format('d/m/Y') ?? '-' }}
                                        </option>
                                    @empty
                                        <option value="">Belum ada audit selesai</option>
                                    @endforelse
                                </select>
                            </form>

                            {{-- LIHAT DETAIL AUDIT --}}
                            @if ($dashboardAudit)
                                <a href="{{ route('audit.result', $dashboardAudit) }}"
                                    class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
                                    Lihat Detail Audit →
                                </a>
                            @endif
                        </div>
                    </div>

                    @if ($dashboardAudit)
                        <div class="rounded-xl bg-emerald-50 border border-emerald-100 p-4">
                            <p class="text-sm text-emerald-700">Nilai Keseluruhan</p>

                            <p class="text-3xl font-bold text-emerald-800 mt-1">
                                {{ number_format($overallPercentage, 2, ',', '.') }}%
                            </p>

                            <p class="text-xs text-emerald-700 mt-2">
                                {{ $totalPoints }} dari 339 poin
                            </p>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-5 gap-5 mb-6">

                            {{-- Chart Perbandingan: 2 bagian --}}
                            <div class="lg:col-span-2 rounded-xl border border-slate-100 p-4">
                                <h4 class="font-semibold text-slate-700">
                                    Perbandingan Nilai Maksimal dan Hasil Audit
                                </h4>

                                <p class="text-xs text-slate-500 mt-1 mb-4">
                                    Persentase pencapaian untuk setiap elemen SMKP
                                </p>

                                <div class="relative h-[420px]">
                                    <canvas id="smkpComparisonChart"></canvas>
                                </div>
                            </div>

                            {{-- Radar Chart: 3 bagian, lebih lebar --}}
                            <div class="lg:col-span-3 rounded-xl border border-slate-100 p-4">
                                <h4 class="font-semibold text-slate-700 mb-3">
                                    Radar Pencapaian Elemen SMKP
                                </h4>

                                <div class="relative h-[420px]">
                                    <canvas id="smkpRadarChart"></canvas>
                                </div>
                            </div>

                        </div>

                        @php
                            $elementWeights = [10, 15, 17, 35, 15, 3, 5];
                        @endphp

                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">

                                <thead>
                                    <tr class="border-b border-slate-200 bg-slate-100 text-left text-slate-600">
                                        <th class="px-4 py-3 font-semibold">Elemen SMKP</th>
                                        <th class="px-4 py-3 text-right font-semibold">Poin Audit</th>
                                        <th class="px-4 py-3 text-right font-semibold">Bobot Elemen</th>
                                        <th class="px-4 py-3 text-right font-semibold">Pencapaian Bobot</th>
                                        <th class="px-4 py-3 text-right font-semibold">Nilai terhadap Bobot</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-slate-200">
                                    @foreach ($elementResults as $result)
                                        @php
                                            $weight = $elementWeights[$loop->index] ?? 0;

                                            $achievementPercentage =
                                                $result->weight_percentage > 0
                                                    ? ($result->contribution_percentage / $result->weight_percentage) *
                                                        100
                                                    : 0;
                                        @endphp

                                        <tr
                                            class="{{ $loop->even ? 'bg-slate-50' : 'bg-white' }} transition-colors hover:bg-blue-50">
                                            <td class="px-4 py-3 text-slate-700">
                                                {{ $result->element->name }}
                                            </td>

                                            <td class="px-4 py-3 text-right font-semibold text-slate-800">
                                                {{ $result->points }} / {{ $result->max_points }} poin
                                            </td>

                                            <td class="px-4 py-3 text-right text-slate-600">
                                                {{ number_format($result->weight_percentage, 2, ',', '.') }}%
                                            </td>

                                            {{-- PENCAPAIAN BOBOT --}}
                                            <td class="px-4 py-3 text-right">
                                                <div class="font-bold text-blue-700">
                                                    {{ number_format($achievementPercentage, 2, ',', '.') }}%
                                                </div>

                                                <div class="mt-1 text-xs text-slate-500">
                                                    dari 100%
                                                </div>
                                            </td>

                                            {{-- NILAI TERHADAP BOBOT --}}
                                            <td class="px-4 py-3 text-right">
                                                <div class="font-bold text-emerald-700">
                                                    {{ number_format($result->contribution_percentage, 2, ',', '.') }}%
                                                </div>

                                                <div class="mt-1 text-xs text-slate-500">
                                                    Nilai:
                                                    {{ number_format($result->contribution_percentage, 2, ',', '.') }}
                                                    /
                                                    {{ number_format($result->weight_percentage, 2, ',', '.') }}%
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr class="border-t-2 border-slate-200 bg-slate-100">
                                        <td colspan="4" class="px-4 py-4 text-left font-bold text-slate-800">
                                            Total
                                        </td>

                                        <td class="px-4 py-4 text-right font-bold text-emerald-700">
                                            {{ number_format($overallPercentage, 2, ',', '.') }}%
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    @else
                        <div class="rounded-xl border border-dashed border-slate-300 p-8 text-center">
                            <p class="font-semibold text-slate-700">Belum ada hasil audit selesai</p>
                            <p class="text-sm text-slate-500 mt-1">
                                Hasil tabel dan radar chart akan muncul setelah audit diselesaikan.
                            </p>
                            <a href="{{ route('audit.index') }}"
                                class="inline-flex mt-4 rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
                                Buka Daftar Audit
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    @if ($dashboardAudit)
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const canvas = document.getElementById('smkpRadarChart');

                if (!canvas || typeof Chart === 'undefined') return;

                new Chart(canvas, {
                    type: 'radar',

                    data: {
                        labels: @json($elementResults->map(fn($result) => $result->element->name)->values()),

                        datasets: [{
                            label: 'Pencapaian Elemen (%)',
                            data: @json($elementResults->pluck('percentage')->values()),
                            fill: true,
                            borderWidth: 2,
                            pointRadius: 4
                        }]
                    },

                    options: {
                        responsive: true,
                        maintainAspectRatio: false,

                        scales: {
                            r: {
                                beginAtZero: true,
                                min: 0,
                                max: 100,

                                ticks: {
                                    stepSize: 20,
                                    callback: value => value + '%'
                                }
                            }
                        },

                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const canvas = document.getElementById('smkpComparisonChart');

                if (!canvas || typeof Chart === 'undefined') return;

                new Chart(canvas, {
                    type: 'bar',

                    data: {
                        labels: @json($elementResults->map(fn($result) => $result->element->name)->values()),

                        datasets: [{
                                label: 'Nilai Maksimal',
                                data: @json($elementResults->map(fn($result) => $result->max_points > 0 ? 100 : 0)->values()),
                                backgroundColor: '#CBD5E1',
                                borderRadius: 5
                            },
                            {
                                label: 'Hasil Audit',
                                data: @json($elementResults->pluck('percentage')->values()),
                                backgroundColor: '#059669',
                                borderRadius: 5
                            }
                        ]
                    },

                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,

                        scales: {
                            x: {
                                beginAtZero: true,
                                max: 100,
                                ticks: {
                                    font: {
                                        size: 10
                                    },
                                    callback: value => value + '%'
                                },
                                title: {
                                    display: true,
                                    text: 'Persentase Pencapaian',
                                    font: {
                                        size: 11
                                    }
                                }
                            },

                            y: {
                                ticks: {
                                    autoSkip: false,
                                    font: {
                                        size: 9
                                    }
                                }
                            }
                        },

                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    font: {
                                        size: 10
                                    },
                                    boxWidth: 12,
                                    padding: 12
                                }
                            },

                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ' +
                                            Number(context.raw).toLocaleString('id-ID', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) + '%';
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endif
</x-app-layout>

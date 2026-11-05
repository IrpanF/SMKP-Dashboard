<x-app-layout>
    <div class="min-h-screen bg-slate-50 px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            {{-- HEADER --}}
            <div class="mb-6">
                <h2 class="text-2xl font-bold tracking-tight text-slate-800">
                    Peta Site UTSG
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Persebaran temuan audit SMKP berdasarkan lokasi site.
                </p>
            </div>

            {{-- RINGKASAN --}}
            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Total Temuan</p>
                    <p class="mt-2 text-3xl font-bold text-slate-800">
                        {{ $totalFindings }}
                    </p>
                    <p class="mt-1 text-xs text-slate-400">Seluruh site yang teridentifikasi</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Terbuka</p>
                    <p class="mt-2 text-3xl font-bold text-red-600">
                        {{ $overallCounts['open'] ?? 0 }}
                    </p>
                    <p class="mt-1 text-xs text-slate-400">Belum ditindaklanjuti</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Menunggu Verifikasi</p>
                    <p class="mt-2 text-3xl font-bold text-amber-600">
                        {{ $overallCounts['pending_verification'] ?? 0 }}
                    </p>
                    <p class="mt-1 text-xs text-slate-400">Menunggu pemeriksaan auditor</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Selesai</p>
                    <p class="mt-2 text-3xl font-bold text-emerald-600">
                        {{ $overallCounts['completed'] ?? 0 }}
                    </p>
                    <p class="mt-1 text-xs text-slate-400">Perbaikan disetujui</p>
                </div>
            </div>

            {{-- PERINGATAN KOORDINAT --}}
            <div class="mb-5 flex gap-3 rounded-xl border border-amber-200 bg-amber-50 p-4">
                <svg class="mt-0.5 h-5 w-5 shrink-0 text-amber-600"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                </svg>
                <div>
                    <p class="text-sm font-semibold text-amber-800">
                        Koordinat peta masih sementara
                    </p>
                    <p class="mt-1 text-sm text-amber-700">
                        Posisi marker merupakan perkiraan awal, bukan titik resmi lokasi operasional.
                        Konfirmasikan koordinat kelima site sebelum peta digunakan sebagai referensi resmi.
                    </p>
                </div>
            </div>

            {{-- PETA --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-5 py-4">
                    <h3 class="font-semibold text-slate-800">Persebaran Lokasi Site</h3>
                    <p class="mt-1 text-xs text-slate-500">
                        Klik marker untuk melihat ringkasan temuan per site.
                    </p>
                </div>

                <div id="siteMap" class="z-0 h-[420px] w-full sm:h-[520px]"></div>
            </div>

            {{-- DAFTAR SITE --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-5 py-4">
                    <h3 class="font-semibold text-slate-800">Ringkasan Temuan per Site</h3>
                    <p class="mt-1 text-xs text-slate-500">
                        Jumlah dihitung dari lokasi yang tercatat pada data temuan.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-0 divide-y divide-slate-100 md:grid-cols-2 md:divide-y-0">
                    @foreach ($sites as $site)
                        <div class="border-slate-100 p-5 {{ !$loop->last ? 'md:border-b' : '' }} {{ $loop->even ? 'md:border-l' : '' }}">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h4 class="font-semibold text-slate-800">
                                        {{ $site['name'] }}
                                    </h4>
                                    <p class="mt-1 text-xs text-amber-600">
                                        {{ $site['coordinate_note'] }}
                                    </p>
                                </div>
                                <span class="rounded-xl bg-slate-100 px-3 py-1.5 text-sm font-bold text-slate-700">
                                    {{ $site['total'] }} temuan
                                </span>
                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3">
                                <div class="rounded-lg bg-red-50 p-3">
                                    <p class="text-xs text-red-600">Terbuka</p>
                                    <p class="mt-1 text-xl font-bold text-red-700">
                                        {{ $site['counts']['open'] ?? 0 }}
                                    </p>
                                </div>

                                <div class="rounded-lg bg-blue-50 p-3">
                                    <p class="text-xs text-blue-600">Dalam Proses</p>
                                    <p class="mt-1 text-xl font-bold text-blue-700">
                                        {{ $site['counts']['in_progress'] ?? 0 }}
                                    </p>
                                </div>

                                <div class="rounded-lg bg-amber-50 p-3">
                                    <p class="text-xs text-amber-600">Perlu Revisi</p>
                                    <p class="mt-1 text-xl font-bold text-amber-700">
                                        {{ $site['counts']['revision_required'] ?? 0 }}
                                    </p>
                                </div>

                                <div class="rounded-lg bg-orange-50 p-3">
                                    <p class="text-xs text-orange-600">Menunggu Verifikasi</p>
                                    <p class="mt-1 text-xl font-bold text-orange-700">
                                        {{ $site['counts']['pending_verification'] ?? 0 }}
                                    </p>
                                </div>

                                <div class="rounded-lg bg-emerald-50 p-3">
                                    <p class="text-xs text-emerald-600">Selesai</p>
                                    <p class="mt-1 text-xl font-bold text-emerald-700">
                                        {{ $site['counts']['completed'] ?? 0 }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    {{-- LEAFLET --}}
    @push('styles')
        <link
            rel="stylesheet"
            href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            crossorigin=""
        />
    @endpush

    @push('scripts')
        <script
            src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            crossorigin=""
        ></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const sites = @json($sites);

                const map = L.map('siteMap', {
                    scrollWheelZoom: false
                });

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                const markers = [];

                sites.forEach(function (site) {
                    const marker = L.marker([site.lat, site.lng]).addTo(map);

                    const counts = site.counts || {};

                    const popup = `
                        <div style="min-width:190px">
                            <strong style="font-size:14px">${site.name}</strong>
                            <p style="margin:6px 0;font-size:12px;color:#64748b">
                                ${site.coordinate_note}
                            </p>
                            <div style="margin-bottom:8px">
                                Total temuan:
                                <strong>${site.total}</strong>
                            </div>
                            <div style="font-size:12px;line-height:1.8">
                                Terbuka: <strong>${counts.open ?? 0}</strong><br>
                                Dalam proses: <strong>${counts.in_progress ?? 0}</strong><br>
                                Perlu revisi: <strong>${counts.revision_required ?? 0}</strong><br>
                                Menunggu verifikasi: <strong>${counts.pending_verification ?? 0}</strong><br>
                                Selesai: <strong>${counts.completed ?? 0}</strong>
                            </div>
                        </div>
                    `;

                    marker.bindPopup(popup);
                    markers.push(marker);
                });

                if (markers.length) {
                    const group = L.featureGroup(markers);
                    map.fitBounds(group.getBounds().pad(0.15));
                } else {
                    map.setView([-2.5, 118], 5);
                }

                // Aktifkan zoom dengan roda mouse setelah peta diklik.
                map.on('click', function () {
                    map.scrollWheelZoom.enable();
                });
            });
        </script>
    @endpush
</x-app-layout>
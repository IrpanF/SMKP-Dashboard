<x-app-layout>

    {{-- CONTENT --}}
    <div class="py-6 bg-slate-50 min-h-[calc(100vh-65px)]">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- WELCOME --}}
            <div class="relative overflow-hidden
                        bg-gradient-to-r from-emerald-700 to-emerald-500
                        rounded-2xl shadow-sm
                        px-6 py-5 mb-5">

                {{-- Decorative --}}
                <div class="absolute -right-10 -top-16
                            w-48 h-48 rounded-full
                            bg-white/10"></div>

                <div class="absolute right-24 -bottom-20
                            w-40 h-40 rounded-full
                            bg-white/5"></div>

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
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-5">

                {{-- Total Audit --}}
                <div class="bg-white rounded-2xl shadow-sm
                            border border-slate-100 p-5">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-slate-500">
                                Total Audit
                            </p>

                            <p class="text-3xl font-bold
                                      text-slate-800 mt-1">
                                24
                            </p>

                            <p class="text-xs text-emerald-600 mt-1">
                                ↑ 12% dari bulan lalu
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl
                                    bg-emerald-100
                                    flex items-center justify-center">

                            <svg class="w-6 h-6 text-emerald-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12
                                         a2 2 0 002 2h10a2 2 0 002-2V7
                                         a2 2 0 00-2-2h-2
                                         M9 5a3 3 0 016 0
                                         M9 5h6"/>
                            </svg>

                        </div>
                    </div>
                </div>


                {{-- Temuan --}}
                <div class="bg-white rounded-2xl shadow-sm
                            border border-slate-100 p-5">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-slate-500">
                                Total Temuan
                            </p>

                            <p class="text-3xl font-bold
                                      text-slate-800 mt-1">
                                86
                            </p>

                            <p class="text-xs text-red-500 mt-1">
                                ↑ 8 temuan baru
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl
                                    bg-red-100
                                    flex items-center justify-center">

                            <svg class="w-6 h-6 text-red-500"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 9v4
                                         m0 4h.01
                                         M10.29 3.86l-8.18 14
                                         A2 2 0 003.84 21h16.32
                                         a2 2 0 001.73-3.14l-8.18-14
                                         a2 2 0 00-3.42 0z"/>
                            </svg>

                        </div>
                    </div>
                </div>


                {{-- Open --}}
                <div class="bg-white rounded-2xl shadow-sm
                            border border-slate-100 p-5">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-slate-500">
                                Temuan Terbuka
                            </p>

                            <p class="text-3xl font-bold
                                      text-slate-800 mt-1">
                                32
                            </p>

                            <p class="text-xs text-amber-600 mt-1">
                                Perlu tindak lanjut
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl
                                    bg-amber-100
                                    flex items-center justify-center">

                            <svg class="w-6 h-6 text-amber-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 8v4l3 2
                                         m6-2a9 9 0 11-18 0
                                         9 9 0 0118 0z"/>
                            </svg>

                        </div>
                    </div>
                </div>


                {{-- Score --}}
                <div class="bg-white rounded-2xl shadow-sm
                            border border-slate-100 p-5">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-slate-500">
                                Nilai SMKP
                            </p>

                            <p class="text-3xl font-bold
                                      text-slate-800 mt-1">
                                92%
                            </p>

                            <p class="text-xs text-emerald-600 mt-1">
                                Sangat Baik
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl
                                    bg-blue-100
                                    flex items-center justify-center">

                            <svg class="w-6 h-6 text-blue-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 19V6l12-3v13
                                         M9 19a3 3 0 11-6 0
                                         3 3 0 016 0z
                                         M21 16a3 3 0 11-6 0
                                         3 3 0 016 0z"/>
                            </svg>

                        </div>
                    </div>
                </div>

            </div>


            {{-- MAIN GRID --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                {{-- AUDIT OVERVIEW --}}
                <div class="lg:col-span-2 bg-white rounded-2xl
                            shadow-sm border border-slate-100 p-5">

                    <div class="flex items-center justify-between mb-5">

                        <div>
                            <h3 class="font-bold text-slate-800">
                                Ringkasan Audit
                            </h3>

                            <p class="text-xs text-slate-500 mt-1">
                                Aktivitas audit tahun berjalan
                            </p>
                        </div>

                        <button
                            class="text-sm font-semibold
                                   text-emerald-600
                                   hover:text-emerald-700">
                            Lihat detail →
                        </button>

                    </div>


                    {{-- Fake Chart --}}
                    <div class="h-48 flex items-end gap-3
                                border-b border-slate-100
                                px-2">

                        @foreach ([45, 65, 50, 78, 62, 88, 72, 95, 80, 90, 76, 100] as $height)

                            <div class="flex-1 flex flex-col
                                        items-center justify-end
                                        h-full">

                                <div
                                    class="w-full max-w-[34px]
                                           bg-emerald-500
                                           rounded-t-lg
                                           hover:bg-emerald-600
                                           transition"
                                    style="height: {{ $height }}%;"
                                ></div>

                            </div>

                        @endforeach

                    </div>


                    <div class="grid grid-cols-6
                                sm:grid-cols-12
                                mt-3 text-[11px]
                                text-slate-400 text-center">

                        @foreach (['Jan','Feb','Mar','Apr','Mei','Jun',
                                  'Jul','Agu','Sep','Okt','Nov','Des'] as $month)

                            <span>{{ $month }}</span>

                        @endforeach

                    </div>

                </div>


                {{-- STATUS TEMUAN --}}
                <div class="bg-white rounded-2xl
                            shadow-sm border border-slate-100 p-5">

                    <div class="mb-5">
                        <h3 class="font-bold text-slate-800">
                            Status Temuan
                        </h3>

                        <p class="text-xs text-slate-500 mt-1">
                            Kondisi temuan saat ini
                        </p>
                    </div>


                    {{-- Progress --}}
                    <div class="space-y-5">

                        {{-- Closed --}}
                        <div>
                            <div class="flex justify-between
                                        text-sm mb-2">

                                <span class="text-slate-600">
                                    Closed
                                </span>

                                <span class="font-semibold
                                             text-emerald-600">
                                    63%
                                </span>

                            </div>

                            <div class="h-2 rounded-full
                                        bg-slate-100 overflow-hidden">

                                <div class="h-full w-[63%]
                                            bg-emerald-500 rounded-full">
                                </div>

                            </div>
                        </div>


                        {{-- Open --}}
                        <div>
                            <div class="flex justify-between
                                        text-sm mb-2">

                                <span class="text-slate-600">
                                    Open
                                </span>

                                <span class="font-semibold
                                             text-amber-600">
                                    27%
                                </span>

                            </div>

                            <div class="h-2 rounded-full
                                        bg-slate-100 overflow-hidden">

                                <div class="h-full w-[27%]
                                            bg-amber-500 rounded-full">
                                </div>

                            </div>
                        </div>


                        {{-- Overdue --}}
                        <div>
                            <div class="flex justify-between
                                        text-sm mb-2">

                                <span class="text-slate-600">
                                    Terlambat
                                </span>

                                <span class="font-semibold
                                             text-red-500">
                                    10%
                                </span>

                            </div>

                            <div class="h-2 rounded-full
                                        bg-slate-100 overflow-hidden">

                                <div class="h-full w-[10%]
                                            bg-red-500 rounded-full">
                                </div>

                            </div>
                        </div>

                    </div>


                    {{-- Total --}}
                    <div class="mt-6 pt-5
                                border-t border-slate-100
                                flex items-center justify-between">

                        <span class="text-sm text-slate-500">
                            Total Temuan
                        </span>

                        <span class="text-xl font-bold text-slate-800">
                            86
                        </span>

                    </div>

                </div>

            </div>


            {{-- QUICK ACCESS --}}
            <div class="mt-5">

                <div class="flex items-center justify-between mb-3">

                    <div>
                        <h3 class="font-bold text-slate-800">
                            Akses Cepat
                        </h3>

                        <p class="text-xs text-slate-500">
                            Menu yang sering digunakan
                        </p>
                    </div>

                </div>


                <div class="grid grid-cols-2
                            sm:grid-cols-3
                            lg:grid-cols-6 gap-3">

                    @foreach ([
                        ['Audit SMKP', 'bg-emerald-100', 'text-emerald-600'],
                        ['Temuan', 'bg-red-100', 'text-red-500'],
                        ['Tindak Lanjut', 'bg-amber-100', 'text-amber-600'],
                        ['Laporan', 'bg-blue-100', 'text-blue-600'],
                        ['Master Data', 'bg-purple-100', 'text-purple-600'],
                        ['Pengguna', 'bg-slate-100', 'text-slate-600'],
                    ] as $menu)

                        <a href="#"
                           class="bg-white rounded-xl
                                  border border-slate-100
                                  shadow-sm p-4
                                  hover:shadow-md
                                  hover:-translate-y-0.5
                                  transition duration-200">

                            <div class="w-10 h-10 rounded-lg
                                        {{ $menu[1] }}
                                        flex items-center justify-center
                                        mb-3">

                                <svg class="w-5 h-5 {{ $menu[2] }}"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M9 12h6
                                             m-6 4h6
                                             m2 5H7
                                             a2 2 0 01-2-2V5
                                             a2 2 0 012-2h5.586
                                             a1 1 0 01.707.293l5.414 5.414
                                             A1 1 0 0119 9.414V19
                                             a2 2 0 01-2 2z"/>
                                </svg>

                            </div>

                            <p class="text-sm font-semibold
                                      text-slate-700">
                                {{ $menu[0] }}
                            </p>

                        </a>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
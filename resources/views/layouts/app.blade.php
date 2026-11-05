<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- <title>{{ config('app.name', 'Sistem Informasi SMKP') }} - Login</title>
    <title>{{ config('app.name', 'SMKP Dashboard') }}</title> --}}
    <title>@yield('title', 'SMKP UTSG')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logo-utsg.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800">

    <div class="min-h-screen flex">
        <div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-slate-900/40" aria-hidden="true">

        </div>

        {{-- SIDEBAR --}}
        <aside id="app-sidebar"
            class="fixed inset-y-0 left-0 z-50 flex w-64
            -translate-x-full flex-col
            border-r border-slate-200 bg-white
            shadow-xl
             transition-transform duration-300 ease-in-out">

            {{-- LOGO --}}
            <div class="h-20 flex items-center px-6
                        border-b border-slate-100">

                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

                    <div class="w-12 h-12 flex items-center justify-center">
                        <img src="{{ asset('images/logo-utsg.ico') }}" alt="Logo UTSG"
                            class="max-h-12 max-w-14 object-contain">
                    </div>

                    <div>
                        <h1 class="font-bold text-xl text-slate-800">
                            SMKP
                        </h1>

                        <p class="text-[10px] text-slate-500
                                  leading-tight">
                            Safety Management System
                        </p>
                    </div>

                </a>

            </div>

            {{-- MENU --}}
            <nav class="flex-1 px-4 py-5 overflow-y-auto">

                {{-- UTAMA --}}
                <p
                    class="px-3 mb-2 text-[10px] font-bold
                          tracking-wider text-slate-400 uppercase">
                    Utama
                </p>

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-xl
                          {{ request()->routeIs('dashboard')
                              ? 'bg-emerald-50 text-emerald-700'
                              : 'text-slate-600 hover:bg-slate-50 hover:text-emerald-600' }}
                          transition">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9
                                 M5 10v10a1 1 0 001 1h4v-6h4v6h4
                                 a1 1 0 001-1V10" />
                    </svg>

                    <span class="text-sm font-medium">
                        Dashboard
                    </span>

                </a>

                {{-- AUDIT SMKP --}}
                <a href="{{ route('audit.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-xl transition
                        {{ request()->routeIs('audit.*')
                            ? 'bg-emerald-50 text-emerald-700'
                            : 'text-slate-600 hover:bg-slate-50 hover:text-emerald-600' }}">

                    {{-- SVG ICON --}}
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12
                            a2 2 0 002 2h10a2 2 0 002-2V7
                            a2 2 0 00-2-2h-2
                            M9 5a3 3 0 016 0
                            M9 5h6" />
                    </svg>

                    <span class="text-sm font-medium">Audit SMKP</span>
                </a>

                {{-- TEMUAN --}}
                <a href="{{ route('findings.index') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-2.5 mb-1 transition
                        {{ request()->routeIs('findings.*')
                            ? 'bg-emerald-50 text-emerald-700'
                            : 'text-slate-600 hover:bg-slate-50 hover:text-emerald-600' }}">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4
                                 m0 4h.01
                                 M10.29 3.86l-8.18 14
                                 A2 2 0 003.84 21h16.32
                                 a2 2 0 001.73-3.14l-8.18-14
                                 a2 2 0 00-3.42 0z" />
                    </svg>

                    <span class="text-sm font-medium">
                        Temuan
                    </span>

                </a>

                {{-- TINDAK LANJUT --}}
                <a href="{{ route('rtl.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-xl transition
                        {{ request()->routeIs('rtl.*')
                            ? 'bg-emerald-50 text-emerald-700'
                            : 'text-slate-600 hover:bg-slate-50 hover:text-emerald-600' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 2
                            m6-2a9 9 0 11-18 0
                            9 9 0 0118 0z" />
                    </svg>

                    <span class="text-sm font-medium">
                        Tindak Lanjut
                    </span>

                </a>

                {{-- VERIFIKASI TEMUAN --}}
                @auth
                    @if (in_array(auth()->user()->role, ['auditor', 'admin']))
                        <a href="{{ route('verification.index') }}"
                            class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-xl transition
                                {{ request()->routeIs('verification.*')
                                    ? 'bg-emerald-50 text-emerald-700'
                                    : 'text-slate-600 hover:bg-slate-50 hover:text-emerald-600' }}">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4
                                                            M12 3l7 4v5
                                                            a8 8 0 01-7 8
                                                            a8 8 0 01-7-8V7l7-4z" />
                            </svg>

                            <span class="text-sm font-medium">
                                Verifikasi Temuan
                            </span>

                        </a>
                    @endif
                @endauth

                {{-- LAPORAN --}}
                <a href="{{ route('laporan.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-xl transition
                        {{ request()->routeIs('laporan.*')
                            ? 'bg-emerald-50 text-emerald-700'
                            : 'text-slate-600 hover:bg-slate-50 hover:text-emerald-600' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 3h7l5 5v13H4V3h4zm7 0v5h5M8 13h8M8 17h8" />
                    </svg>
                    <span class="text-sm font-medium">
                        Laporan
                    </span>
                </a>

                {{-- MASTER DATA --}}
                <div class="mt-6 mb-2">

                    <p
                        class="px-3 text-[10px] font-bold
                              tracking-wider text-slate-400 uppercase">
                        Master Data
                    </p>

                </div>

                {{-- MASTER DATA SMKP --}}
                <a href="{{ route('master-data.smkp') }}"
                    class="flex items-center gap-3 px-3 py-2.5 mb-1
                        rounded-xl transition
                        {{ request()->routeIs('master-data.smkp')
                            ? 'bg-emerald-50 text-emerald-700'
                            : 'text-slate-600 hover:bg-slate-50 hover:text-emerald-600' }}">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v14
                            a1 1 0 01-1 1H5a1 1 0 01-1-1V5z
                            M8 8h8M8 12h8M8 16h5" />
                    </svg>

                    <span class="text-sm font-medium">
                        Master Data SMKP
                    </span>
                </a>

                {{-- DEPARTEMEN --}}
                {{-- <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 mb-1
                          rounded-xl text-slate-600
                          hover:bg-slate-50
                          hover:text-emerald-600
                          transition">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2
                                 a3 3 0 00-5.356-1.857
                                 M17 20H7
                                 m10 0v-2
                                 a3 3 0 00-3-3H10
                                 a3 3 0 00-3 3v2
                                 m0 0H2v-2
                                 a3 3 0 015.356-1.857
                                 M16 7a4 4 0 11-8 0
                                 4 4 0 018 0z" />
                    </svg>

                    <span class="text-sm font-medium">
                        Departemen
                    </span>

                </a> --}}

                {{-- LOKASI SITE UTSG --}}
                {{-- @auth
                    @if (in_array(auth()->user()->role, ['auditor', 'admin']))
                        <a href="{{ route('sites.map') }}"
                            class="flex items-center gap-3 px-3 py-2.5 mb-1
                                rounded-xl
                                {{ request()->routeIs('sites.map')
                                    ? 'bg-emerald-50 text-emerald-700'
                                    : 'text-slate-600 hover:bg-slate-50 hover:text-emerald-600' }}
                                transition">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 21
                                                     a2 2 0 01-2.828 0l-4.243-4.343
                                                     a8 8 0 1111.314 0z
                                                     M15 11a3 3 0 11-6 0
                                                     3 3 0 016 0z" />
                            </svg>

                            <span class="text-sm font-medium">
                                Lokasi Site
                            </span>
                        </a>
                    @endif
                @endauth --}}

                {{-- PENGGUNA --}}
                @if (auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('users.index') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm mb-1 transition
                            {{ request()->routeIs('users.*')
                                ? 'bg-emerald-50 text-emerald-700'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-emerald-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="10" cy="7" r="4" />
                            <path d="M20 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        <span class="text-sm font-medium">
                            Users
                        </span>
                    </a>
                @endif

            </nav>

        </aside>

        {{-- MAIN CONTENT --}}
        <div class="min-w-0 flex-1">
            {{-- TOP NAVBAR --}}
            <header
                class="relative z-30 sticky top-0 flex h-20 items-center gap-4
               border-b border-slate-200 bg-white px-4 sm:px-6 lg:px-8">

                {{-- TOMBOL SIDEBAR --}}
                <button id="sidebar-toggle" type="button" aria-label="Buka menu navigasi"
                    aria-controls="app-sidebar" aria-expanded="false"
                    class="flex h-10 w-10 shrink-0 items-center justify-center
               rounded-xl border border-slate-200 bg-white
               text-slate-600 transition hover:bg-emerald-50
               hover:text-emerald-700 focus:outline-none
               focus:ring-2 focus:ring-emerald-500">

                    <svg id="sidebar-toggle-icon" class="h-6 w-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                {{-- JUDUL HALAMAN: DI SAMPING HAMBURGER --}}
                <div class="min-w-0 flex-1">
                    @php
                        $pageTitle = match (true) {
                            request()->routeIs('dashboard') => 'Dashboard',
                            request()->routeIs('audit.checklist') => 'Audit SMKP',
                            request()->routeIs('master-data.smkp') => 'Master Data SMKP',
                            request()->routeIs('profile.*') => 'Pengaturan Akun',
                            default => 'SMKP Dashboard',
                        };
                    @endphp

                    <h1 class="truncate text-lg font-bold text-slate-800 sm:text-xl">
                        {{ $pageTitle }}
                    </h1>

                    <p class="hidden truncate text-xs text-slate-500 sm:block">
                        Sistem Manajemen Keselamatan Pertambangan
                    </p>
                </div>

                {{-- BAGIAN KANAN NAVBAR --}}
                <div class="ml-auto flex shrink-0 items-center gap-2 sm:gap-4">

                    {{-- NOTIFIKASI --}}
                    <button type="button" aria-label="Notifikasi"
                        class="relative flex h-10 w-10 items-center justify-center
                   rounded-xl text-slate-500 hover:bg-slate-50">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>

                        <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-red-500"></span>
                    </button>

                    {{-- ADMIN MENU --}}
                    <div class="relative" id="admin-menu-container">

                        <button type="button" id="admin-menu-toggle" aria-expanded="false"
                            aria-controls="admin-dropdown"
                            class="flex items-center gap-2 rounded-xl border
                       border-slate-200 bg-white px-2 py-2 transition
                       hover:border-emerald-300 hover:bg-emerald-50 sm:gap-3 sm:px-3">

                            {{-- AVATAR --}}
                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center
                            rounded-xl bg-emerald-100">
                                <span class="font-bold text-emerald-700">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                            </div>

                            {{-- NAMA PENGGUNA --}}
                            <div class="hidden text-left sm:block">
                                <p class="max-w-36 truncate text-sm font-semibold text-slate-700">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-xs text-slate-400">Admin</p>
                            </div>

                            {{-- PANAH --}}
                            <svg id="admin-menu-arrow" class="h-4 w-4 text-slate-500 transition-transform"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m6 9 6 6 6-6" />
                            </svg>
                        </button>

                        {{-- DROPDOWN ADMIN --}}
                        <div id="admin-dropdown"
                            class="absolute right-0 top-full z-50 mt-2 hidden
                       w-60 overflow-hidden rounded-xl border
                       border-slate-200 bg-white shadow-lg">

                            <div class="border-b border-slate-100 px-4 py-3">
                                <p class="truncate text-sm font-semibold text-slate-800">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="truncate text-xs text-slate-500">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>

                            {{-- PENGATURAN AKUN --}}
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-3 px-4 py-3 text-sm
                           text-slate-700 transition hover:bg-emerald-50
                           hover:text-emerald-700">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19.4 15a1.7 1.7 0 00.34 1.88l.06.06-1.7 2.94-.08-.02a1.7 1.7 0 00-1.72.58l-.05.07h-3.4l-.05-.07a1.7 1.7 0 00-1.72-.58l-.08.02-1.7-2.94.06-.06A1.7 1.7 0 009.7 15l-.08-.04v-3.4l.08-.06a1.7 1.7 0 00-.34-1.88L9.3 9.56l1.7-2.94.08.02a1.7 1.7 0 001.72-.58l.05-.07h3.4l.05.07a1.7 1.7 0 001.72.58l.08-.02 1.7 2.94-.06.06a1.7 1.7 0 00.34 1.88l.08.04v3.4l-.08.04z" />
                                </svg>

                                <span>Pengaturan Akun</span>
                            </a>

                            {{-- KELUAR --}}
                            <div class="border-t border-slate-100 p-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit"
                                        class="flex w-full items-center gap-3 rounded-lg
                                   px-3 py-3 text-left text-sm font-medium
                                   text-red-600 transition hover:bg-red-50">

                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3" />
                                        </svg>

                                        <span>Keluar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @stack('styles')
            </header>

            {{-- PAGE HEADER MOBILE --}}
            @isset($header)
                <div class="lg:hidden bg-white border-b border-slate-100
                            px-4 py-4">

                    {{ $header }}

                </div>
            @endisset

            {{-- PAGE CONTENT --}}
            <main>
                {{ $slot }}
            </main>

        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const adminToggle = document.getElementById('admin-menu-toggle');
            const adminDropdown = document.getElementById('admin-dropdown');
            const adminContainer = document.getElementById('admin-menu-container');
            const adminArrow = document.getElementById('admin-menu-arrow');

            if (adminToggle && adminDropdown && adminContainer) {
                function closeAdminMenu() {
                    adminDropdown.classList.add('hidden');
                    adminToggle.setAttribute('aria-expanded', 'false');
                    adminArrow?.classList.remove('rotate-180');
                }

                adminToggle.addEventListener('click', function(event) {
                    event.stopPropagation();

                    const isOpen =
                        adminToggle.getAttribute('aria-expanded') === 'true';

                    if (isOpen) {
                        closeAdminMenu();
                    } else {
                        adminDropdown.classList.remove('hidden');
                        adminToggle.setAttribute('aria-expanded', 'true');
                        adminArrow?.classList.add('rotate-180');
                    }
                });

                document.addEventListener('click', function(event) {
                    if (!adminContainer.contains(event.target)) {
                        closeAdminMenu();
                    }
                });

                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        closeAdminMenu();
                    }
                });
            }

            const sidebar = document.getElementById('app-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const toggle = document.getElementById('sidebar-toggle');
            const icon = document.getElementById('sidebar-toggle-icon');

            if (!sidebar || !overlay || !toggle) return;

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');

                overlay.classList.remove('hidden');

                toggle.setAttribute('aria-expanded', 'true');
                toggle.setAttribute('aria-label', 'Tutup menu navigasi');

                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" ' +
                    'stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');

                overlay.classList.add('hidden');

                toggle.setAttribute('aria-expanded', 'false');
                toggle.setAttribute('aria-label', 'Buka menu navigasi');

                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" ' +
                    'stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />';
            }

            toggle.addEventListener('click', function() {
                const isOpen =
                    toggle.getAttribute('aria-expanded') === 'true';

                if (isOpen) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            });

            overlay.addEventListener('click', closeSidebar);

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeSidebar();
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Sistem Informasi SMKP') }} - Login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logo-utsg.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 overflow-hidden">

    <div class="h-screen flex items-center justify-center p-4">

        <div
            class="w-full max-w-6xl h-[calc(100vh-32px)] max-h-[680px]
                    bg-white rounded-3xl shadow-xl overflow-hidden
                    grid grid-cols-1 lg:grid-cols-2">

            {{-- ================================================= --}}
            {{-- LEFT SIDE --}}
            {{-- ================================================= --}}
            <div
                class="relative bg-gradient-to-br from-emerald-700 to-emerald-500
                        text-white px-8 py-7 lg:px-12 lg:py-8
                        flex flex-col justify-between overflow-hidden">

                {{-- Decorative --}}
                <div class="absolute -top-24 -right-24
                            w-72 h-72 bg-white/10 rounded-full">
                </div>

                <div
                    class="absolute -bottom-32 -left-24
                            w-80 h-80 bg-white/10 rounded-full">
                </div>


                <div class="relative z-10">

                    {{-- Logo --}}
                    <div class="flex items-center gap-3">

                        <div
                            class="w-16 h-12 bg-white rounded-xl
                                    flex items-center justify-center shadow-lg">

                            <div class="w-12 h-12 flex items-center justify-center">
                                <img src="{{ asset('images/logo-utsg.ico') }}" alt="Logo UTSG"
                                    class="max-h-12 max-w-14 object-contain">
                            </div>

                        </div>

                        <div>
                            <h1 class="text-2xl font-bold">
                                SMKP
                            </h1>

                            <p class="text-emerald-100 text-xs">
                                Sistem Manajemen Keselamatan Pertambangan
                            </p>
                        </div>

                    </div>


                    {{-- Main Content --}}
                    <div class="mt-16">

                        <p class="text-emerald-100 text-sm font-medium
                                  tracking-wide">

                            SISTEM INFORMASI

                        </p>

                        <h2
                            class="mt-2 text-3xl lg:text-4xl
                                   font-bold leading-tight">

                            Keselamatan adalah
                            <span class="text-yellow-300">
                                prioritas utama.
                            </span>

                        </h2>

                        <p
                            class="mt-4 text-sm lg:text-base
                                  text-emerald-50 leading-relaxed
                                  max-w-md">

                            Kelola kegiatan keselamatan pertambangan
                            secara terintegrasi, terukur, dan
                            berkelanjutan.

                        </p>

                    </div>


                    {{-- Compact Illustration --}}
                    <div class="mt-8 flex justify-center">

                        <div class="relative w-60 h-28">

                            {{-- Sun --}}
                            <div
                                class="absolute top-0 right-5
                                        w-11 h-11 bg-yellow-300
                                        rounded-full">
                            </div>

                            {{-- Mountain --}}
                            <div
                                class="absolute bottom-0 left-2
                                        border-l-[70px] border-l-transparent
                                        border-r-[70px] border-r-transparent
                                        border-b-[95px]
                                        border-b-emerald-900/30">
                            </div>

                            <div
                                class="absolute bottom-0 right-2
                                        border-l-[55px] border-l-transparent
                                        border-r-[55px] border-r-transparent
                                        border-b-[75px]
                                        border-b-emerald-900/20">
                            </div>

                            {{-- Shield --}}
                            <div
                                class="absolute bottom-2 left-1/2
                                        -translate-x-1/2
                                        w-16 h-16
                                        bg-white/15 rounded-full
                                        flex items-center justify-center">

                                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3l7 4v5c0 4.5-3 7.5-7 9
                                             -4-1.5-7-4.5-7-9V7l7-4z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M9 12l2 2 4-4" />

                                </svg>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Footer --}}
                <div class="relative z-10 text-xs text-emerald-100">
                    © {{ date('Y') }} SMKP Dashboard
                </div>

            </div>


            {{-- ================================================= --}}
            {{-- RIGHT SIDE --}}
            {{-- ================================================= --}}
            <div class="flex items-center justify-center
                        px-8 py-6 lg:px-14">

                <div class="w-full max-w-md">

                    {{-- Header --}}
                    <div class="mb-6">
                        <p class="text-emerald-600 font-semibold text-xs uppercase tracking-wider">
                            Silakan masukkan akun Anda untuk melanjutkan.
                        </p>
                    </div>

                    {{-- Session Status --}}
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    {{-- Form --}}
                    <form method="POST" action="{{ route('login') }}" class="space-y-4">

                        @csrf


                        {{-- Nomor Karyawan --}}
                        <div>
                            <x-input-label for="employee_number" value="Nomor Karyawan"
                                class="text-slate-700 font-semibold text-sm" />

                            <div class="relative mt-1.5">
                                {{-- Ikon kartu identitas --}}
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <rect x="3" y="5" width="18" height="14" rx="2"
                                            stroke-width="1.8" />
                                        <circle cx="8" cy="11" r="2" stroke-width="1.8" />
                                        <path d="M5.5 16c.5-1.5 1.3-2 2.5-2s2 .5 2.5 2M14 10h4M14 14h4"
                                            stroke-width="1.8" stroke-linecap="round" />
                                    </svg>
                                </div>

                                <x-text-input id="employee_number"
                                    class="block w-full !pl-11 pr-4 py-3 rounded-xl
                                        border-slate-300 text-lg placeholder:text-base
                                        focus:border-emerald-500 focus:ring-emerald-500"
                                    type="text" name="employee_number" :value="old('employee_number')" required autofocus
                                    inputmode="numeric" maxlength="5" autocomplete="off"
                                    placeholder="Masukkan 5 digit nomor karyawan" />
                            </div>

                            <x-input-error :messages="$errors->get('employee_number')" class="mt-1" />

                            <p class="mt-1 text-xs text-slate-500">
                                Nomor karyawan terdiri dari tepat 5 angka.
                            </p>
                        </div>


                        {{-- Password --}}
                        <div>
                            <x-input-label for="password" value="Password"
                                class="text-slate-700 font-semibold text-sm" />

                            <div class="relative mt-1.5">
                                {{-- Ikon gembok --}}
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <rect x="4" y="10" width="16" height="11" rx="2"
                                            stroke-width="1.8" />
                                        <path d="M8 10V7a4 4 0 0 1 8 0v3" stroke-width="1.8" stroke-linecap="round" />
                                        <circle cx="12" cy="15" r="1" stroke-width="1.8" />
                                        <path d="M12 16v2" stroke-width="1.8" stroke-linecap="round" />
                                    </svg>
                                </div>

                                <x-text-input id="password"
                                    class="block w-full !pl-11 !pr-12 py-3 rounded-xl
                                        border-slate-300 text-lg placeholder:text-base
                                        focus:border-emerald-500 focus:ring-emerald-500"
                                    type="password" name="password" required autocomplete="current-password"
                                    placeholder="Masukkan password Anda" />

                                {{-- Tombol tampil/sembunyikan password --}}
                                <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-0 flex items-center
                   px-3.5 text-slate-400 hover:text-emerald-600
                   focus:outline-none transition"
                                    aria-label="Tampilkan password" aria-pressed="false" title="Tampilkan password">
                                    {{-- Ikon mata --}}
                                    <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z" stroke-width="1.8"
                                            stroke-linejoin="round" />
                                        <circle cx="12" cy="12" r="3" stroke-width="1.8" />
                                    </svg>

                                    {{-- Ikon mata dicoret --}}
                                    <svg id="eyeOffIcon" class="hidden w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M3 3l18 18M10.6 10.6a2 2 0 0 0 2.8 2.8" stroke-width="1.8"
                                            stroke-linecap="round" />
                                        <path
                                            d="M9.9 5.2A10.7 10.7 0 0 1 12 5c6.4 0 10 7 10 7a16 16 0 0 1-3.1 3.9M6.2 6.2C3.5 8 2 12 2 12s3.6 7 10 7c1.3 0 2.5-.3 3.6-.8"
                                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>

                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        {{-- Remember --}}
                        <div class="flex items-center justify-between">

                            <label for="remember_me" class="inline-flex items-center cursor-pointer">

                                <input id="remember_me" type="checkbox"
                                    class="rounded border-slate-300
                                           text-emerald-600
                                           focus:ring-emerald-500"
                                    name="remember">

                                <span class="ms-2 text-sm text-slate-600">
                                    Ingat saya
                                </span>

                            </label>


                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm font-medium
                                           text-emerald-600
                                           hover:text-emerald-700">
                                    Lupa password?
                                </a>
                            @endif

                        </div>


                        {{-- Button --}}
                        <button type="submit"
                            class="w-full py-3 rounded-xl
                                   bg-emerald-600
                                   hover:bg-emerald-700
                                   text-white
                                   font-semibold text-base
                                   shadow-lg shadow-emerald-600/20
                                   transition duration-200">
                            Masuk ke Sistem
                        </button>

                    </form>

                    {{-- Register --}}
                    {{-- @if (Route::has('register'))
                        <div class="mt-4 text-center">

                            <p class="text-sm text-slate-500">
                                Belum punya akun?
                                <a href="{{ route('register') }}"
                                    class="font-semibold text-emerald-600
                                           hover:text-emerald-700
                                           transition">
                                    Daftar sekarang
                                </a>
                            </p>

                        </div>
                    @endif --}}

                    {{-- Info --}}
                    <div
                        class="mt-6 p-3.5 rounded-xl
                                bg-emerald-50
                                border border-emerald-100">

                        <div class="flex gap-2.5">

                            <svg class="w-5 h-5 text-emerald-600
                                        flex-shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01
                                         M12 22a10 10 0 100-20
                                         10 10 0 000 20z" />

                            </svg>

                            <p class="text-xs text-emerald-800
                                      leading-relaxed">

                                Gunakan akun perusahaan Anda untuk
                                mengakses sistem SMKP.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('togglePassword');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeOffIcon = document.getElementById('eyeOffIcon');

            if (!passwordInput || !toggleButton) return;

            toggleButton.addEventListener('click', function() {
                const isHidden = passwordInput.type === 'password';

                passwordInput.type = isHidden ? 'text' : 'password';

                eyeIcon.classList.toggle('hidden', isHidden);
                eyeOffIcon.classList.toggle('hidden', !isHidden);

                toggleButton.setAttribute(
                    'aria-label',
                    isHidden ? 'Sembunyikan password' : 'Tampilkan password'
                );

                toggleButton.setAttribute(
                    'title',
                    isHidden ? 'Sembunyikan password' : 'Tampilkan password'
                );

                toggleButton.setAttribute(
                    'aria-pressed',
                    isHidden ? 'true' : 'false'
                );
            });
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register - SMKP Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 overflow-hidden">

    <div class="h-screen flex items-center justify-center p-4">

        <div class="w-full max-w-6xl h-[calc(100vh-32px)] max-h-[680px]
                    bg-white rounded-3xl shadow-xl overflow-hidden
                    grid grid-cols-1 lg:grid-cols-2">

            {{-- ================================================= --}}
            {{-- LEFT SIDE --}}
            {{-- ================================================= --}}
            <div class="relative bg-gradient-to-br from-emerald-700 to-emerald-500
                        text-white px-8 py-7 lg:px-12 lg:py-8
                        flex flex-col justify-between overflow-hidden">

                {{-- Decorative --}}
                <div class="absolute -top-24 -right-24
                            w-72 h-72 bg-white/10 rounded-full"></div>

                <div class="absolute -bottom-32 -left-24
                            w-80 h-80 bg-white/10 rounded-full"></div>


                <div class="relative z-10">

                    {{-- Logo --}}
                    <div class="flex items-center gap-3">

                        <div class="w-16 h-12 bg-white rounded-xl
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

                        <h2 class="mt-2 text-3xl lg:text-4xl
                                   font-bold leading-tight">

                            Bersama menjaga
                            <span class="text-yellow-300">
                                keselamatan.
                            </span>

                        </h2>

                        <p class="mt-4 text-sm lg:text-base
                                  text-emerald-50 leading-relaxed
                                  max-w-md">

                            Daftarkan akun Anda untuk mengakses
                            sistem manajemen keselamatan pertambangan.

                        </p>

                    </div>


                    {{-- Compact Illustration --}}
                    <div class="mt-8 flex justify-center">

                        <div class="relative w-60 h-28">

                            {{-- Sun --}}
                            <div class="absolute top-0 right-5
                                        w-11 h-11 bg-yellow-300
                                        rounded-full">
                            </div>

                            {{-- Mountain --}}
                            <div class="absolute bottom-0 left-2
                                        border-l-[70px] border-l-transparent
                                        border-r-[70px] border-r-transparent
                                        border-b-[95px]
                                        border-b-emerald-900/30">
                            </div>

                            <div class="absolute bottom-0 right-2
                                        border-l-[55px] border-l-transparent
                                        border-r-[55px] border-r-transparent
                                        border-b-[75px]
                                        border-b-emerald-900/20">
                            </div>

                            {{-- Shield --}}
                            <div class="absolute bottom-2 left-1/2
                                        -translate-x-1/2
                                        w-16 h-16
                                        bg-white/15 rounded-full
                                        flex items-center justify-center">

                                <svg class="w-9 h-9 text-white"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M12 3l7 4v5c0 4.5-3 7.5-7 9
                                             -4-1.5-7-4.5-7-9V7l7-4z"/>

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M9 12l2 2 4-4"/>

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
                    <div class="mb-5">

                        <p class="text-emerald-600 font-semibold
                                  text-xs uppercase tracking-wider">

                            Buat Akun

                        </p>

                        <h2 class="mt-1.5 text-3xl font-bold
                                   text-slate-800">

                            Daftar Akun

                        </h2>

                        <p class="mt-2 text-sm text-slate-500">

                            Lengkapi data berikut untuk membuat akun.

                        </p>

                    </div>


                    {{-- Form --}}
                    <form method="POST"
                          action="{{ route('register') }}"
                          class="space-y-3.5">

                        @csrf


                        {{-- Name --}}
                        <div>

                            <x-input-label
                                for="name"
                                value="Nama Lengkap"
                                class="text-slate-700 font-semibold text-sm"
                            />

                            <x-text-input
                                id="name"
                                class="block mt-1 w-full px-4 py-2.5
                                       rounded-xl border-slate-300
                                       text-base
                                       focus:border-emerald-500
                                       focus:ring-emerald-500"
                                type="text"
                                name="name"
                                :value="old('name')"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="Masukkan nama lengkap"
                            />

                            <x-input-error
                                :messages="$errors->get('name')"
                                class="mt-1"
                            />

                        </div>


                        {{-- Email --}}
                        <div>

                            <x-input-label
                                for="email"
                                value="Email"
                                class="text-slate-700 font-semibold text-sm"
                            />

                            <x-text-input
                                id="email"
                                class="block mt-1 w-full px-4 py-2.5
                                       rounded-xl border-slate-300
                                       text-base
                                       focus:border-emerald-500
                                       focus:ring-emerald-500"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autocomplete="username"
                                placeholder="Masukkan email"
                            />

                            <x-input-error
                                :messages="$errors->get('email')"
                                class="mt-1"
                            />

                        </div>


                        {{-- Password --}}
                        <div>

                            <x-input-label
                                for="password"
                                value="Password"
                                class="text-slate-700 font-semibold text-sm"
                            />

                            <x-text-input
                                id="password"
                                class="block mt-1 w-full px-4 py-2.5
                                       rounded-xl border-slate-300
                                       text-base
                                       focus:border-emerald-500
                                       focus:ring-emerald-500"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Masukkan password"
                            />

                            <x-input-error
                                :messages="$errors->get('password')"
                                class="mt-1"
                            />

                        </div>


                        {{-- Confirm Password --}}
                        <div>

                            <x-input-label
                                for="password_confirmation"
                                value="Konfirmasi Password"
                                class="text-slate-700 font-semibold text-sm"
                            />

                            <x-text-input
                                id="password_confirmation"
                                class="block mt-1 w-full px-4 py-2.5
                                       rounded-xl border-slate-300
                                       text-base
                                       focus:border-emerald-500
                                       focus:ring-emerald-500"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Ulangi password"
                            />

                            <x-input-error
                                :messages="$errors->get('password_confirmation')"
                                class="mt-1"
                            />

                        </div>


                        {{-- Actions --}}
                        <div class="flex items-center justify-between pt-2">

                            <a
                                href="{{ route('login') }}"
                                class="text-sm font-medium
                                       text-emerald-600
                                       hover:text-emerald-700"
                            >
                                ← Sudah punya akun?
                            </a>


                            <button
                                type="submit"
                                class="px-7 py-3 rounded-xl
                                       bg-emerald-600
                                       hover:bg-emerald-700
                                       text-white
                                       font-semibold text-base
                                       shadow-lg
                                       shadow-emerald-600/20
                                       transition duration-200"
                            >
                                Daftar
                            </button>

                        </div>

                    </form>


                    {{-- Info --}}
                    <div class="mt-5 p-3 rounded-xl
                                bg-emerald-50
                                border border-emerald-100">

                        <div class="flex gap-2.5">

                            <svg class="w-5 h-5 text-emerald-600
                                        flex-shrink-0"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M13 16h-1v-4h-1m1-4h.01
                                         M12 22a10 10 0 100-20
                                         10 10 0 000 20z"/>

                            </svg>

                            <p class="text-xs text-emerald-800
                                      leading-relaxed">

                                Pastikan data akun yang Anda masukkan
                                sudah benar.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>
</html>
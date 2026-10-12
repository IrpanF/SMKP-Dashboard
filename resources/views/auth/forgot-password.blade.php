<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lupa Password - SMKP Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

    <div class="min-h-screen flex items-center justify-center p-4">

        <div class="w-full max-w-6xl min-h-[600px] max-h-[680px]
                    bg-white rounded-3xl shadow-xl overflow-hidden
                    grid grid-cols-1 lg:grid-cols-2">

            {{-- LEFT SIDE --}}
            <div class="relative bg-gradient-to-br from-emerald-700 to-emerald-500
                        text-white px-8 py-8 lg:px-12 lg:py-8
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
                            <h1 class="text-2xl font-bold">SMKP</h1>
                            <p class="text-emerald-100 text-xs">
                                Sistem Manajemen Keselamatan Pertambangan
                            </p>
                        </div>

                    </div>

                    {{-- Main Content --}}
                    <div class="mt-16">

                        <p class="text-emerald-100 text-sm font-medium tracking-wide">
                            PEMULIHAN AKUN
                        </p>

                        <h2 class="mt-2 text-3xl lg:text-4xl font-bold leading-tight">
                            Jangan khawatir,
                            <span class="text-yellow-300">
                                akun Anda bisa dipulihkan.
                            </span>
                        </h2>

                        <p class="mt-4 text-sm lg:text-base text-emerald-50
                                  leading-relaxed max-w-md">
                            Kami akan membantu Anda mendapatkan kembali akses
                            ke sistem SMKP melalui tautan reset password
                            yang dikirimkan ke email terdaftar.
                        </p>

                    </div>

                    {{-- Illustration --}}
                    <div class="mt-10 flex justify-center">

                        <div class="relative w-60 h-32">

                            <div class="absolute top-0 right-5
                                        w-11 h-11 bg-yellow-300 rounded-full">
                            </div>

                            <div class="absolute bottom-0 left-2
                                        border-l-[70px] border-l-transparent
                                        border-r-[70px] border-r-transparent
                                        border-b-[95px] border-b-emerald-900/30">
                            </div>

                            <div class="absolute bottom-0 right-2
                                        border-l-[55px] border-l-transparent
                                        border-r-[55px] border-r-transparent
                                        border-b-[75px] border-b-emerald-900/20">
                            </div>

                            <div class="absolute bottom-2 left-1/2
                                        -translate-x-1/2 w-16 h-16
                                        bg-white/15 rounded-full
                                        flex items-center justify-center">

                                <svg class="w-9 h-9 text-white"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M12 11V7a4 4 0 018 0v4"/>
                                    <rect x="5" y="11" width="14" height="11"
                                          rx="2" stroke-width="1.8"/>
                                    <circle cx="12" cy="16" r="1"
                                            stroke-width="1.8"/>
                                </svg>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Footer --}}
                <div class="relative z-10 text-xs text-emerald-100 mt-6">
                    © {{ date('Y') }} SMKP Dashboard
                </div>

            </div>

            {{-- RIGHT SIDE --}}
            <div class="flex items-center justify-center px-8 py-10 lg:px-14">

                <div class="w-full max-w-md">

                    {{-- Header --}}
                    <div class="mb-7">

                        <div class="w-14 h-14 rounded-2xl bg-emerald-50
                                    flex items-center justify-center mb-5">

                            <svg class="w-7 h-7 text-emerald-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-8a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M8 9V6a4 4 0 018 0v3"/>
                            </svg>

                        </div>

                        <p class="text-emerald-600 font-semibold text-xs
                                  uppercase tracking-wider">
                            Bantuan Akun
                        </p>

                        <h2 class="mt-1.5 text-3xl font-bold text-slate-800">
                            Lupa Password?
                        </h2>

                        <p class="mt-3 text-sm text-slate-500 leading-relaxed">
                            Tidak masalah. Masukkan alamat email yang Anda
                            gunakan saat mendaftar. Kami akan mengirimkan
                            tautan untuk membuat password baru.
                        </p>

                    </div>

                    {{-- Session Status --}}
                    <x-auth-session-status
                        class="mb-4"
                        :status="session('status')"
                    />

                    {{-- Form --}}
                    <form method="POST"
                          action="{{ route('password.email') }}"
                          class="space-y-5">

                        @csrf

                        <div>

                            <x-input-label
                                for="email"
                                value="Alamat Email"
                                class="text-slate-700 font-semibold text-sm"
                            />

                            <x-text-input
                                id="email"
                                class="block mt-1.5 w-full px-4 py-3
                                       rounded-xl border-slate-300 text-base
                                       focus:border-emerald-500
                                       focus:ring-emerald-500"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autofocus
                                autocomplete="email"
                                placeholder="nama@perusahaan.com"
                            />

                            <x-input-error
                                :messages="$errors->get('email')"
                                class="mt-1"
                            />

                        </div>

                        {{-- Submit --}}
                        <button
                            type="submit"
                            class="w-full py-3 rounded-xl
                                   bg-emerald-600 hover:bg-emerald-700
                                   text-white font-semibold text-base
                                   shadow-lg shadow-emerald-600/20
                                   transition duration-200">
                            Kirim Tautan Reset Password
                        </button>

                    </form>

                    {{-- Back to Login --}}
                    <div class="mt-6 text-center">

                        <a href="{{ route('login') }}"
                           class="inline-flex items-center justify-center gap-2
                                  text-sm font-semibold text-emerald-600
                                  hover:text-emerald-700 transition">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>

                            Kembali ke halaman login

                        </a>

                    </div>

                    {{-- Info --}}
                    <div class="mt-7 p-4 rounded-xl bg-emerald-50
                                border border-emerald-100">

                        <div class="flex gap-2.5">

                            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0"
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

                            <p class="text-xs text-emerald-800 leading-relaxed">
                                Pastikan email Anda benar dan dapat diakses.
                                Periksa folder spam jika email reset belum
                                muncul di kotak masuk.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>
</html>
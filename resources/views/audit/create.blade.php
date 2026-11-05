<x-app-layout>
    <div class="min-h-screen bg-slate-50 p-4 sm:p-6">
        <div class="mx-auto max-w-3xl">

            <a href="{{ route('audit.index') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-emerald-700">
                <span aria-hidden="true">←</span>
                Kembali ke Daftar Audit
            </a>

            <div class="mb-6 mt-5">
                <p class="text-sm font-semibold text-emerald-700">Audit SMKP</p>
                <h1 class="mt-1 text-2xl font-bold text-slate-800">Buat Audit Baru</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Isi informasi audit sebelum memulai penilaian.
                </p>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 bg-gradient-to-r from-emerald-50 to-white p-5 sm:p-6">
                    <h2 class="font-bold text-slate-800">Informasi Audit</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Audit akan disimpan sebagai draft dan dapat dilanjutkan nanti.
                    </p>
                </div>

                <form method="POST" action="{{ route('audit.store') }}" class="space-y-6 p-5 sm:p-6">
                    @csrf

                    <div>
                        <label for="title" class="mb-2 block text-sm font-semibold text-slate-700">
                            Judul Audit <span class="text-red-500">*</span>
                        </label>

                        <div
                            class="flex flex-col overflow-hidden rounded-xl border border-slate-300 bg-white shadow-sm sm:flex-row sm:items-center focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100">

                            {{-- Input tambahan --}}
                            <input type="text" id="title" name="title"
                                value="{{ old('title', 'Audit Internal SMKP Minerba') }}" required maxlength="255"
                                autofocus placeholder="Masukkan judul audit"
                                class="w-full rounded-xl border-slate-300 text-sm shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:ring-emerald-500">
                        </div>

                        <p class="mt-2 text-xs text-slate-500">
                            Judul awal sudah ditentukan. Silakan tambahkan periode atau keterangan audit.
                        </p>

                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="site_id" class="mb-2 block text-sm font-semibold text-slate-700">
                            Site <span class="text-red-500">*</span>
                        </label>

                        <select id="site_id" name="site_id" required
                            class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            <option value="">-- Pilih Site --</option>

                            @foreach ($sites as $site)
                                <option value="{{ $site->id }}"
                                    {{ (string) old('site_id') === (string) $site->id ? 'selected' : '' }}>
                                    {{ $site->company_name }} - Site {{ $site->site_name }}
                                </option>
                            @endforeach
                        </select>

                        @error('site_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Periode Audit --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Periode Audit <span class="text-red-500">*</span>
                        </label>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                            {{-- Tanggal Mulai --}}
                            <div>
                                <label for="audit_start_date" class="mb-2 block text-sm font-medium text-slate-600">
                                    Tanggal Mulai Audit
                                </label>

                                <input type="date" id="audit_start_date" name="audit_start_date"
                                    value="{{ old('audit_start_date', now()->format('Y-m-d')) }}" required
                                    class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                                @error('audit_start_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tanggal Selesai --}}
                            <div>
                                <label for="audit_end_date" class="mb-2 block text-sm font-medium text-slate-600">
                                    Tanggal Selesai Audit
                                </label>

                                <input type="date" id="audit_end_date" name="audit_end_date"
                                    value="{{ old('audit_end_date') }}"
                                    min="{{ old('audit_start_date', now()->format('Y-m-d')) }}" required
                                    class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                                @error('audit_end_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <p class="mt-2 text-xs text-slate-500">
                            Tentukan tanggal dimulainya audit hingga tanggal berakhirnya audit.
                        </p>
                    </div>

                    <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">
                        <p class="text-sm font-semibold text-blue-800">Status awal: Draft</p>
                        <p class="mt-1 text-sm leading-relaxed text-blue-700">
                            Kamu bisa menyimpan penilaian secara bertahap dan melanjutkannya kembali.
                            Audit belum dianggap selesai sampai proses penyelesaian ditambahkan.
                        </p>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                        <a href="{{ route('audit.index') }}"
                            class="inline-flex justify-center rounded-xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                            Buat Audit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

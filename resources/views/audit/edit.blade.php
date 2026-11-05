<x-app-layout>
    <div class="min-h-screen bg-slate-50 p-4 sm:p-6">
        <div class="mx-auto max-w-3xl">

            <div class="mb-6">
                <p class="text-sm font-semibold text-emerald-700">
                    Audit SMKP
                </p>
                <h1 class="mt-1 text-2xl font-bold text-slate-800">
                    Edit Audit
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Ubah informasi audit yang masih berstatus Draft.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <form action="{{ route('audit.update', $audit) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="title" class="mb-2 block text-sm font-semibold text-slate-700">
                            Judul Audit
                        </label>

                        <input type="text" id="title" name="title" value="{{ old('title', $audit->title) }}"
                            required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100">

                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="site_id" class="mb-2 block text-sm font-semibold text-slate-700">
                            Site <span class="text-red-500">*</span>
                        </label>

                        <select id="site_id" name="site_id" required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100">

                            <option value="">-- Pilih Site --</option>

                            @foreach ($sites as $site)
                                <option value="{{ $site->id }}" @selected((string) old('site_id', $audit->site_id) === (string) $site->id)>
                                    {{ $site->company_name }} - Site {{ $site->site_name }}
                                </option>
                            @endforeach
                        </select>

                        @error('site_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- Periode Audit --}}
                    <div class="mb-6">
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
                                    value="{{ old('audit_start_date', $audit->audit_start_date?->format('Y-m-d')) }}"
                                    required
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100">

                                @error('audit_start_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tanggal Selesai --}}
                            <div>
                                <label for="audit_end_date" class="mb-2 block text-sm font-medium text-slate-600">
                                    Tanggal Selesai Audit
                                </label>

                                <input type="date" id="audit_end_date" name="audit_end_date"
                                    value="{{ old('audit_end_date', $audit->audit_end_date?->format('Y-m-d')) }}"
                                    min="{{ old('audit_start_date', $audit->audit_start_date?->format('Y-m-d')) }}"
                                    required
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100">

                                @error('audit_end_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <p class="mt-2 text-xs text-slate-500">
                            Tentukan tanggal dimulainya audit hingga tanggal berakhirnya audit.
                        </p>
                    </div>

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                        <a href="{{ route('audit.index') }}"
                            class="rounded-xl border border-slate-300 px-5 py-3 text-center text-sm font-semibold text-slate-600 hover:bg-slate-50">
                            Batal
                        </a>

                        <button type="submit"
                            class="rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white hover:bg-emerald-700">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>

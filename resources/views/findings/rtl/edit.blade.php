<x-app-layout>
    @php
        $input =
            'w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100';
        $label = 'mb-1.5 block text-sm font-medium text-slate-700';
        $err = 'mt-1.5 text-xs text-red-600';
        $card = 'rounded-2xl border border-slate-200 bg-white shadow-sm';
        $cardHead = 'flex items-center gap-3 border-b border-slate-100 px-5 py-4 sm:px-6';
        $iconBox = 'flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700';
        $title = 'font-bold text-slate-800';
        $desc = 'text-xs text-slate-500';
        $drop =
            'flex cursor-pointer items-center gap-4 rounded-xl border-2 border-dashed border-emerald-200 bg-emerald-50/50 px-4 py-4 transition hover:border-emerald-400 hover:bg-emerald-50';
    @endphp

    <div class="min-h-screen bg-slate-50 px-3 pb-12 pt-6 sm:px-4 lg:px-5">
        <div class="mx-auto max-w-7xl">

            {{-- HEADER --}}
            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <div class="mb-2 flex flex-wrap items-center gap-2 text-sm text-slate-500">
                        <a href="{{ url('/dashboard') }}" class="hover:text-emerald-700">Dashboard</a>
                        <span>/</span>
                        <a href="{{ route('rtl.index') }}" class="hover:text-emerald-700">Tindak Lanjut</a>
                        <span>/</span>
                        <span class="font-medium text-emerald-700">Isi RTL</span>
                    </div>

                    <h1 class="text-2xl font-bold tracking-tight text-slate-800 sm:text-3xl">
                        Rencana Tindak Lanjut
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Lengkapi atau perbarui tindakan perbaikan dan bukti tindak lanjut temuan audit SMKP.
                    </p>

                    @php
                        $rtlStatusLabels = [
                            'open' => 'Belum Dikerjakan',
                            'in_progress' => 'Sedang Dikerjakan',
                            'revision_required' => 'Perlu Revisi',
                        ];

                        $rtlStatusColors = [
                            'open' => 'bg-slate-100 text-slate-700',
                            'in_progress' => 'bg-blue-100 text-blue-700',
                            'revision_required' => 'bg-red-100 text-red-700',
                        ];
                    @endphp

                    <div class="mt-3">
                        <span
                            class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                {{ $rtlStatusColors[$finding->status] ?? 'bg-slate-100 text-slate-700' }}">
                            Status: {{ $rtlStatusLabels[$finding->status] ?? $finding->status }}
                        </span>
                    </div>
                </div>

                <a href="{{ route('rtl.index') }}"
                    class="inline-flex items-center justify-center gap-2 self-start rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-emerald-300 hover:bg-emerald-50 sm:self-auto">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">
                    <p class="font-semibold text-red-800">Periksa kembali isian berikut:</p>
                    <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="mb-6">
                {{-- KLASIFIKASI TEMUAN --}}
                <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-100 px-5 py-4">
                        <h3 class="font-semibold text-slate-800">
                            Klasifikasi Temuan
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2">
                        @foreach ([
        'Kriteria Temuan' => $finding->finding_criteria,
        'Kategori Temuan' => $finding->finding_category,
    ] as $label => $value)
                            <div>
                                <p class="mb-1 text-xs font-medium uppercase tracking-wide text-slate-500">
                                    {{ $label }}
                                </p>
                                <p class="break-words text-sm font-semibold text-slate-800">
                                    {{ filled($value) ? $value : '-' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- IDENTITAS TEMUAN --}}
                <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-100 px-5 py-4">
                        <h3 class="font-semibold text-slate-800">
                            Identitas Temuan
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ([
        'Nomor Temuan' => $finding->finding_no,
        'Nomor Form' => $finding->form_no,
        'Revisi' => $finding->revision,
        'Audit' => $finding->audit?->title,
        'Tanggal Audit' => $finding->audit_date?->format('d/m/Y'),
        'Halaman' => $finding->page,
        'Lokasi' => $finding->location_name,
        'Standar / Acuan' => $finding->standard,
    ] as $label => $value)
                            <div>
                                <p class="mb-1 text-xs font-medium uppercase tracking-wide text-slate-500">
                                    {{ $label }}
                                </p>
                                <p class="break-words text-sm font-semibold text-slate-800">
                                    {{ filled($value) ? $value : '-' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- AUDIT FINDINGS (PLOR) --}}
                <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-100 px-5 py-4">
                        <h3 class="font-semibold text-slate-800">
                            Audit Findings (PLOR)
                        </h3>
                    </div>

                    <div class="space-y-5 p-5">
                        @foreach ([
        'Problem' => $finding->problem,
        'Location' => $finding->area_temuan,
        'Objective' => $finding->objective,
        'Reference / Matriks' => $finding->matriks,
        'Risk' => $finding->risk,
        'Recommendation' => $finding->recommendation,
    ] as $label => $value)
                            <div>
                                <p class="mb-2 text-sm font-semibold text-slate-700">
                                    {{ $label }}
                                </p>
                                <div
                                    class="whitespace-pre-line break-words rounded-xl bg-slate-50 p-4 text-sm leading-6 text-slate-600">
                                    {{ filled($value) ? $value : '-' }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </section>

            <form action="{{ route('rtl.update', $finding->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')


                {{-- BUKTI TEMUAN AWAL DARI AUDITOR --}}
                <section class="{{ $card }}">
                    <div class="{{ $cardHead }}">
                        <div class="{{ $iconBox }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16l4-4a2 2 0 013 0l3 3m-1-1l2-2a2 2 0 013 0l2 2M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="{{ $title }}">Bukti Temuan Awal</h2>
                            <p class="{{ $desc }}">
                                Dokumentasi yang dilampirkan auditor saat mencatat temuan.
                            </p>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6">
                        @php
                            $evidenceFiles = $finding->evidence_files ?? [];

                            if (is_string($evidenceFiles)) {
                                $evidenceFiles = json_decode($evidenceFiles, true) ?? [];
                            }
                        @endphp

                        @if (count($evidenceFiles))
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                @foreach ($evidenceFiles as $file)
                                    @php
                                        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                                        $isPdf = $extension === 'pdf';

                                        $fileType = $isImage
                                            ? 'Foto Bukti Temuan Awal'
                                            : ($isPdf
                                                ? 'Dokumen PDF'
                                                : 'Dokumen');

                                        $fileUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($file);
                                    @endphp

                                    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white">
                                        @if ($isImage)
                                            <a href="{{ $fileUrl }}" target="_blank" rel="noopener noreferrer">
                                                <img src="{{ $fileUrl }}" alt="Bukti temuan awal" loading="lazy"
                                                    class="h-48 w-full bg-slate-50 object-contain">
                                            </a>
                                            <div class="border-t border-slate-100 p-3">
                                                <p class="mb-1 text-xs font-semibold text-emerald-700">
                                                    {{ $fileType }}
                                                </p>
                                                <p class="truncate text-xs text-slate-600">
                                                    {{ basename($file) }}
                                                </p>
                                                <a href="{{ $fileUrl }}" target="_blank" rel="noopener noreferrer"
                                                    class="mt-2 inline-block text-xs font-semibold text-emerald-700">
                                                    Lihat gambar ukuran penuh ↗
                                                </a>
                                            </div>
                                        @else
                                            <div class="flex items-center gap-3 p-4">
                                                <span
                                                    class="rounded-lg bg-red-50 px-3 py-2 text-xs font-bold text-red-600">
                                                    {{ strtoupper($extension) }}
                                                </span>

                                                <div class="min-w-0 flex-1">
                                                    <p class="mb-1 text-xs font-semibold text-emerald-700">
                                                        {{ $fileType }}
                                                    </p>

                                                    <a href="{{ $fileUrl }}" target="_blank"
                                                        rel="noopener noreferrer"
                                                        class="break-all text-sm font-medium text-emerald-700">
                                                        {{ basename($file) }} ↗
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="rounded-xl bg-slate-50 p-4 text-sm text-slate-500">
                                Tidak ada bukti temuan awal yang dilampirkan.
                            </p>
                        @endif
                    </div>
                </section>

                {{-- TINDAKAN PERBAIKAN --}}
                <section class="{{ $card }}">
                    <div class="{{ $cardHead }}">
                        <div class="{{ $iconBox }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="{{ $title }}">Manajemen Respons (RTL)</h2>
                            <p class="{{ $desc }}">Jelaskan tindakan koreksi dan pencegahan yang dilakukan.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-5 p-5 sm:p-6">


                        <div>
                            <label for="root_cause" class="{{ $label }}">
                                Akar Permasalahan <span class="text-red-500">*</span>
                            </label>
                            <textarea id="root_cause" name="root_cause" rows="4" required
                                placeholder="Jelaskan penyebab utama terjadinya temuan..." class="{{ $input }}">{{ old('root_cause', $finding->root_cause) }}</textarea>
                            @error('root_cause')
                                <p class="{{ $err }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="rtl_response" class="{{ $label }}">
                                Tindakan Koreksi <span class="text-red-500">*</span>
                            </label>
                            <textarea id="rtl_response" name="rtl_response" rows="5" required
                                placeholder="Jelaskan tindakan perbaikan, langkah pencegahan, dan hasil yang diharapkan..."
                                class="{{ $input }}">{{ old('rtl_response', $finding->rtl_response) }}</textarea>
                            @error('rtl_response')
                                <p class="{{ $err }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">

                            <div>
                                <label for="function_name" class="{{ $label }}">
                                    Fungsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="function_name" name="function_name"
                                    value="{{ old('function_name', $finding->function_name) }}" maxlength="150"
                                    required placeholder="Contoh: Operasional" class="{{ $input }}">
                                @error('function_name')
                                    <p class="{{ $err }}">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="auditee" class="{{ $label }}">
                                    PIC / Penanggung Jawab <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="auditee" name="auditee"
                                    value="{{ old('auditee', $finding->auditee ?: auth()->user()->name) }}"
                                    maxlength="150" required placeholder="Nama PIC" class="{{ $input }}">
                                @error('auditee')
                                    <p class="{{ $err }}">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="action_days" class="{{ $label }}">
                                    Target Penyelesaian <span class="text-red-500">*</span>
                                </label>
                                <div class="flex">
                                    <input type="number" id="action_days" name="action_days"
                                        value="{{ old('action_days', $finding->action_days ?: 7) }}" min="1"
                                        required class="{{ $input }} rounded-r-none">
                                    <span
                                        class="inline-flex items-center rounded-r-xl border border-l-0 border-slate-200 bg-emerald-50 px-4 text-sm font-medium text-emerald-700">
                                        hari
                                    </span>
                                </div>
                                @error('action_days')
                                    <p class="{{ $err }}">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </section>

                {{-- BUKTI PERBAIKAN --}}
                <section class="{{ $card }}">
                    <div class="{{ $cardHead }}">
                        <div class="{{ $iconBox }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.2 7l-6.5 6.5a2 2 0 102.8 2.8l7-7a4 4 0 00-5.7-5.7l-7 7a6 6 0 008.5 8.5" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="{{ $title }}">Evidence Perbaikan</h2>
                            <p class="{{ $desc }}">
                                Lampirkan bukti perbaikan dan tuliskan keterangan untuk setiap file.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-5 p-5 sm:p-6">
                        @php
                            $rtlFiles = $finding->rtl_files ?? [];
                            $rtlCaptions = $finding->rtl_file_captions ?? [];

                            if (is_string($rtlFiles)) {
                                $rtlFiles = json_decode($rtlFiles, true) ?? [];
                            }

                            if (is_string($rtlCaptions)) {
                                $rtlCaptions = json_decode($rtlCaptions, true) ?? [];
                            }

                            if (!is_array($rtlFiles)) {
                                $rtlFiles = [];
                            }

                            if (!is_array($rtlCaptions)) {
                                $rtlCaptions = [];
                            }
                        @endphp

                        {{-- FILE LAMA --}}
                        @if (count($rtlFiles))
                            <div class="rounded-xl border border-emerald-200 bg-emerald-50/60 p-4">
                                <p class="mb-3 text-sm font-semibold text-emerald-800">
                                    Bukti yang sudah tersimpan
                                </p>

                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                    @foreach ($rtlFiles as $index => $file)
                                        @php
                                            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                            $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                                            $fileUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($file);
                                            $caption = $rtlCaptions[$index] ?? '';
                                        @endphp

                                        <div class="relative overflow-hidden rounded-xl border border-emerald-100 bg-white"
                                            data-existing-rtl-file>

                                            <button type="button"
                                                class="absolute right-2 top-2 z-10 flex h-8 w-8 items-center justify-center
               rounded-full bg-white/95 text-slate-600 shadow-md ring-1 ring-slate-200
               transition hover:bg-red-500 hover:text-white"
                                                title="Hapus bukti ini" aria-label="Hapus bukti ini"
                                                data-remove-rtl-file="{{ $file }}"
                                                onclick="removeExistingRtlFile(this)">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 6l12 12M18 6L6 18" />
                                                </svg>
                                            </button>
                                            @if ($isImage)
                                                <a href="{{ $fileUrl }}" target="_blank"
                                                    rel="noopener noreferrer">
                                                    <img src="{{ $fileUrl }}"
                                                        alt="{{ $caption ?: 'Bukti perbaikan' }}" loading="lazy"
                                                        class="h-44 w-full bg-slate-50 object-contain">
                                                </a>
                                            @else
                                                <div class="flex h-24 items-center justify-center bg-slate-50">
                                                    <div class="text-center">
                                                        <span
                                                            class="inline-flex rounded-lg bg-red-50 px-3 py-2 text-sm font-bold text-red-600">
                                                            {{ strtoupper($extension ?: 'FILE') }}
                                                        </span>
                                                        <p class="mt-2 text-xs text-slate-500">Dokumen terlampir</p>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="space-y-2 border-t border-slate-100 p-3">
                                                <p class="break-words text-sm font-semibold text-slate-800">
                                                    {{ $caption ?: 'Belum ada keterangan.' }}
                                                </p>

                                                <p class="break-all text-xs text-slate-400">
                                                    {{ basename($file) }}
                                                </p>

                                                <a href="{{ $fileUrl }}" target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="inline-block text-xs font-semibold text-emerald-700 hover:text-emerald-800">
                                                    Buka file ↗
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <p class="mt-3 text-xs leading-5 text-slate-500">
                                    Klik tombol ✕ pada bukti yang ingin dihapus. Perubahan akan
                                    diterapkan setelah kamu menyimpan RTL. Kamu juga bisa menambahkan
                                    bukti baru tanpa menghapus bukti lama lainnya.
                                </p>
                            </div>
                        @endif

                        {{-- UPLOAD FILE BARU --}}
                        <div>
                            <label for="rtl_files" class="{{ $label }}">
                                Unggah Bukti Perbaikan
                                @if (empty($rtlFiles))
                                    <span class="text-red-500">*</span>
                                @else
                                    <span class="text-xs font-normal text-slate-400">
                                        (Opsional jika bukti lama masih sesuai)
                                    </span>
                                @endif
                            </label>

                            <label for="rtl_files" class="{{ $drop }}">
                                <span
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 16V4m0 0L7 9m5-5l5 5M4 16v3a1 1 0 001 1h14a1 1 0 001-1v-3" />
                                    </svg>
                                </span>
                                <span>
                                    <span class="block text-sm font-semibold text-slate-700">
                                        Klik untuk memilih file
                                    </span>
                                    <span class="mt-1 block text-xs text-slate-500">
                                        JPG, PNG, WEBP, atau PDF · Maksimal 5 MB per file
                                    </span>
                                </span>
                            </label>

                            <input id="rtl_files" name="rtl_files[]" type="file"
                                accept=".jpg,.jpeg,.png,.webp,.pdf" multiple
                                @if (empty($rtlFiles)) required @endif class="sr-only">

                            @error('rtl_files')
                                <p class="{{ $err }}">{{ $message }}</p>
                            @enderror
                            @error('rtl_files.*')
                                <p class="{{ $err }}">{{ $message }}</p>
                            @enderror

                            <div id="rtl_files_list" class="mt-4 space-y-4">
                                <p class="text-xs text-slate-400">
                                    Belum ada file baru dipilih.
                                </p>
                            </div>

                            @foreach ($errors->get('rtl_file_captions.*') as $messages)
                                @foreach ($messages as $message)
                                    <p class="{{ $err }}">{{ $message }}</p>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </section>

                {{-- STATUS DAN PENGIRIMAN --}}
                <section class="rounded-2xl border border-amber-200 bg-amber-50/70 p-4 sm:p-5">
                    <div class="flex items-start gap-3">
                        <span
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3m0 4h.01M10.3 3.86L1.82 18a2 2 0 001.7 3h16.96a2 2 0 001.7-3L13.7 3.86a2 2 0 00-3.4 0z" />
                            </svg>
                        </span>
                        <div>
                            <h2 class="font-bold text-amber-900">Periksa sebelum mengirim</h2>
                            <p class="mt-1 text-sm leading-6 text-amber-800">
                                Pastikan uraian tindakan dan bukti sudah sesuai. Setelah dikirim,
                                RTL menunggu verifikasi auditor. Temuan belum dianggap selesai
                                sebelum disetujui oleh pihak yang berwenang.
                            </p>
                        </div>
                    </div>
                </section>

                {{-- ACTION --}}
                <div
                    class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-xs text-slate-500">
                        <span class="text-red-500">*</span> Wajib diisi
                    </p>

                    <div class="flex flex-col-reverse gap-3 sm:flex-row">
                        <a href="{{ route('rtl.index') }}"
                            class="rounded-xl border border-slate-200 px-5 py-2.5 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                            Batal
                        </a>

                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-emerald-200">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            @if ($finding->status === 'revision_required')
                                Kirim Ulang RTL untuk Verifikasi
                            @elseif ($finding->status === 'in_progress')
                                Simpan Perubahan & Kirim Verifikasi
                            @else
                                Kirim RTL untuk Verifikasi
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- PREVIEW FILE BARU DAN INPUT KETERANGAN --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('rtl_files');
            const list = document.getElementById('rtl_files_list');

            if (!input || !list) return;

            let selectedFiles = [];

            function renderFiles() {
                list.replaceChildren();

                if (selectedFiles.length === 0) {
                    const empty = document.createElement('p');
                    empty.className = 'text-xs text-slate-400';
                    empty.textContent = 'Belum ada file baru dipilih.';
                    list.appendChild(empty);
                    return;
                }

                selectedFiles.forEach((file, index) => {
                    const item = document.createElement('div');
                    item.className =
                        'relative overflow-hidden rounded-xl border border-slate-200 bg-white';

                    const removeButton = document.createElement('button');
                    removeButton.type = 'button';
                    removeButton.className =
                        'absolute right-2 top-2 z-10 flex h-8 w-8 items-center justify-center rounded-full bg-white text-slate-600 shadow ring-1 ring-slate-200 transition hover:bg-red-500 hover:text-white';
                    removeButton.textContent = '×';
                    removeButton.title = 'Hapus file pilihan';
                    removeButton.setAttribute('aria-label', 'Hapus ' + file.name);

                    removeButton.addEventListener('click', function() {
                        selectedFiles.splice(index, 1);
                        syncInput();
                        renderFiles();
                    });

                    const content = document.createElement('div');
                    content.className = 'flex items-start gap-3 p-3';

                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        img.alt = 'Preview ' + file.name;
                        img.className =
                            'h-20 w-20 shrink-0 rounded-lg bg-slate-50 object-cover';
                        content.appendChild(img);
                    } else {
                        const badge = document.createElement('div');
                        badge.className =
                            'flex h-20 w-20 shrink-0 items-center justify-center rounded-lg bg-red-50 text-sm font-bold text-red-600';
                        badge.textContent = 'PDF';
                        content.appendChild(badge);
                    }

                    const details = document.createElement('div');
                    details.className = 'min-w-0 flex-1 pr-8';

                    const filename = document.createElement('p');
                    filename.className = 'break-all text-xs font-semibold text-slate-700';
                    filename.textContent = file.name;

                    const size = document.createElement('p');
                    size.className = 'mt-1 text-xs text-slate-400';
                    size.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';

                    details.append(filename, size);
                    content.appendChild(details);
                    item.append(content, removeButton);

                    const captionWrap = document.createElement('div');
                    captionWrap.className = 'border-t border-slate-100 p-3';

                    const label = document.createElement('label');
                    label.className = 'mb-1.5 block text-sm font-medium text-slate-700';
                    label.htmlFor = 'rtl_file_caption_' + index;
                    label.textContent = 'Keterangan bukti ' + (index + 1) + ' *';

                    const textarea = document.createElement('textarea');
                    textarea.id = 'rtl_file_caption_' + index;
                    textarea.name = 'rtl_file_captions[' + index + ']';
                    textarea.rows = 2;
                    textarea.maxLength = 1000;
                    textarea.required = true;
                    textarea.placeholder = 'Jelaskan bukti perbaikan ini';
                    textarea.className =
                        'w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100';

                    captionWrap.append(label, textarea);
                    item.appendChild(captionWrap);
                    list.appendChild(item);
                });
            }

            function syncInput() {
                const dataTransfer = new DataTransfer();

                selectedFiles.forEach(file => dataTransfer.items.add(file));
                input.files = dataTransfer.files;
            }

            input.addEventListener('change', function() {
                const incomingFiles = Array.from(input.files);

                incomingFiles.forEach(file => selectedFiles.push(file));

                // Sinkronkan kembali file pilihan dan indeks keterangan.
                syncInput();
                renderFiles();
            });
        });
    </script>

    <script>
        function removeExistingRtlFile(button) {
            const card = button.closest('[data-existing-rtl-file]');

            if (!card) return;

            const filePath = button.dataset.removeRtlFile;

            if (!filePath) return;

            // Hindari membuat input penghapusan ganda.
            const form = button.closest('form');

            if (!form) return;

            const alreadyMarked = Array.from(
                form.querySelectorAll('input[name="remove_rtl_files[]"]')
            ).some(input => input.value === filePath);

            if (!alreadyMarked) {
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'remove_rtl_files[]';
                hidden.value = filePath;
                form.appendChild(hidden);
            }

            card.remove();
        }
    </script>

</x-app-layout>

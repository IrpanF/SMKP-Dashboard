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

    <div class="min-h-screen bg-slate-50 px-3 pb-32 pt-6 sm:px-4 lg:px-5">
        <div class="mx-auto max-w-7xl">

            {{-- Header --}}
            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                        <a href="{{ url('/dashboard') }}" class="transition hover:text-emerald-700">Dashboard</a>
                        <span>/</span>
                        <a href="{{ url('/findings') }}" class="transition hover:text-emerald-700">Temuan Audit</a>
                        <span>/</span>
                        <span class="font-medium text-emerald-700">Tambah Temuan</span>
                    </div>
                    <h1 class="text-2xl font-bold tracking-tight text-slate-800 sm:text-3xl">Tambah Temuan Audit</h1>
                    <p class="mt-1 text-sm text-slate-500">Lengkapi temuan hasil audit SMKP dengan format PLOR.</p>
                </div>

                <a href="{{ url('/findings') }}"
                    class="inline-flex items-center justify-center gap-2 self-start rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-emerald-300 hover:bg-emerald-50 sm:self-auto">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            {{-- Error Validasi --}}
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

            <form action="{{ route('findings.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- ===== Klasifikasi temuan ===== --}}
                <section class="{{ $card }}">
                    <div class="{{ $cardHead }}">
                        <div class="{{ $iconBox }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m5.6-4.1A11.96 11.96 0 0112 2.9 11.96 11.96 0 013.4 6c-.3 1-.4 2-.4 3 0 5.6 3.8 10.3 9 11.6 5.2-1.3 9-6 9-11.6 0-1-.1-2-.4-3z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="{{ $title }}">Klasifikasi Temuan</h2>
                            <p class="{{ $desc }}">Tingkat pengulangan dan kategori temuan.</p>
                        </div>
                    </div>

                    <div class="space-y-6 p-5 sm:p-6">
                        <div>
                            <p class="{{ $label }}">Kriteria temuan <span class="text-red-500">*</span></p>
                            <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                                @foreach (['A' => 1, 'B' => 2, 'C' => 3, 'D' => 4] as $k => $yr)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="finding_criteria" value="{{ $k }}"
                                            class="peer sr-only" @checked(old('finding_criteria', 'A') === $k) required>
                                        <span
                                            class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-3.5 py-3 transition hover:border-emerald-300 hover:bg-emerald-50 peer-checked:border-emerald-400 peer-checked:bg-emerald-50 peer-checked:ring-4 peer-checked:ring-emerald-100 peer-focus-visible:ring-4 peer-focus-visible:ring-emerald-200">
                                            <span
                                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-lg font-bold text-emerald-700">{{ $k }}</span>
                                            <span class="text-xs leading-4 text-slate-600">Berulang<br>tahun
                                                ke-{{ $yr }}</span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            @error('finding_criteria')
                                <p class="{{ $err }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <p class="{{ $label }}">Kategori temuan</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach (['critical' => 'Critical', 'mayor' => 'Mayor', 'minor' => 'Minor', 'ofi' => 'OFI'] as $val => $text)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="finding_category" value="{{ $val }}"
                                            class="peer sr-only" @checked(old('finding_category', 'minor') === $val) required>
                                        <span
                                            class="inline-block rounded-xl border border-slate-200 bg-white px-5 py-2 text-sm font-medium text-slate-600 transition hover:border-emerald-300 hover:bg-emerald-50 peer-checked:border-emerald-400 peer-checked:bg-emerald-100 peer-checked:text-emerald-800 peer-focus-visible:ring-4 peer-focus-visible:ring-emerald-200">
                                            {{ $text }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            @error('finding_category')
                                <p class="{{ $err }}">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>

                {{-- ===== Identitas ===== --}}
                <section class="{{ $card }}">
                    <div class="{{ $cardHead }}">
                        <div class="{{ $iconBox }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="{{ $title }}">Identitas Temuan</h2>
                            <p class="{{ $desc }}">Data administrasi sesuai dokumen hasil pemeriksaan.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-x-5 gap-y-4 p-5 sm:grid-cols-2 sm:p-6">
                        <div class="sm:col-span-2">
                            <label for="smkp_audit_id" class="{{ $label }}">
                                Audit SMKP <span class="text-red-500">*</span>
                            </label>
                            <select id="smkp_audit_id" name="smkp_audit_id" required class="{{ $input }}">
                                <option value="">Pilih audit</option>
                                @foreach ($audits as $audit)
                                    <option value="{{ $audit->id }}" @selected((string) old('smkp_audit_id') === (string) $audit->id)>
                                        {{ $audit->title }}
                                        @if ($audit->audit_date)
                                            — {{ $audit->audit_date->format('d/m/Y') }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('smkp_audit_id')
                                <p class="{{ $err }}">{{ $message }}</p>
                            @enderror
                            @if ($audits->isEmpty())
                                <p class="mt-2 text-xs text-amber-700">
                                    Belum ada audit yang tersedia. Buat audit terlebih dahulu.
                                </p>
                            @endif
                        </div>

                        <div>
                            <label for="form_no" class="{{ $label }}">
                                Nomor form <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="form_no" name="form_no"
                                value="{{ old('form_no', 'F.3001000/002') }}" required class="{{ $input }}">
                            @error('form_no')
                                <p class="{{ $err }}">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label for="finding_no" class="{{ $label }}">
                                Nomor Temuan
                            </label>

                            <input type="text" id="finding_no" value="Dibuat otomatis oleh sistem" readonly
                                class="{{ $input }} cursor-not-allowed bg-slate-100 font-semibold text-emerald-700">

                            <p class="mt-1.5 text-xs text-slate-500">
                                Nomor temuan akan dibuat otomatis berdasarkan kategori dan site
                                setelah data disimpan.
                            </p>
                        </div>

                        <div>
                            <label for="audit_date" class="{{ $label }}">
                                Tanggal audit <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="audit_date" name="audit_date" value="{{ old('audit_date') }}"
                                required class="{{ $input }}">
                            @error('audit_date')
                                <p class="{{ $err }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="revision" class="{{ $label }}">Revisi</label>
                                <input type="number" id="revision" name="revision" min="0"
                                    value="{{ old('revision', 0) }}" class="{{ $input }}">
                                @error('revision')
                                    <p class="{{ $err }}">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="page" class="{{ $label }}">Halaman</label>
                                <input type="number" id="page" name="page" min="1"
                                    value="{{ old('page', 1) }}" class="{{ $input }}">
                                @error('page')
                                    <p class="{{ $err }}">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        <div>
                            <label for="location_name" class="{{ $label }}">
                                Lokasi / Site <span class="text-red-500">*</span>
                            </label>

                            <select id="location_name" name="location_name" required class="{{ $input }}">
                                <option value="">Pilih Site</option>

                                @foreach ($sites as $site)
                                    <option value="{{ $site->site_name }}" @selected(old('location_name') === $site->site_name)>
                                        {{ $site->site_name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('location_name')
                                <p class="{{ $err }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="standard" class="{{ $label }}">
                                Standar / acuan <span class="text-red-500">*</span>
                            </label>

                            <input type="text" id="standard" name="standard"
                                value="{{ old('standard', 'SMKP Minerba') }}" placeholder="Standar / acuan audit"
                                required class="{{ $input }}">

                            @error('standard')
                                <p class="{{ $err }}">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>

                {{-- ===== Uraian PLOR ===== --}}
                <section class="{{ $card }}">
                    <div class="{{ $cardHead }}">
                        <div class="{{ $iconBox }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3m0 4h.01M10.29 3.86l-8.1 14.02A2 2 0 003.92 21h16.16a2 2 0 001.73-3.12l-8.1-14.02a2 2 0 00-3.42 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="{{ $title }}">Audit Findings (PLOR)</h2>
                            <p class="{{ $desc }}">Detail ketidaksesuaian dan bukti temuan.</p>
                        </div>
                    </div>

                    <div class="space-y-5 p-5 sm:p-6">
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <div>
                                <label for="problem" class="{{ $label }}">Problem (permasalahan) <span
                                        class="text-red-500">*</span></label>
                                <textarea id="problem" name="problem" rows="4" placeholder="Uraikan fakta ketidaksesuaian yang ditemukan"
                                    required class="{{ $input }}">{{ old('problem') }}</textarea>
                                @error('problem')
                                    <p class="{{ $err }}">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="area_temuan" class="{{ $label }}">Location (area temuan) <span
                                        class="text-red-500">*</span></label>
                                <textarea id="area_temuan" name="area_temuan" rows="4"
                                    placeholder="Contoh: workshop, jalur hauling, area kerja" required class="{{ $input }}">{{ old('area_temuan') }}</textarea>
                                @error('area_temuan')
                                    <p class="{{ $err }}">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            {{-- Reference --}}
                            <div class="rounded-xl border border-emerald-100 bg-emerald-50/60 p-4">

                                <div class="mb-3 flex flex-wrap items-center justify-between gap-3">
                                    <label for="matriks" class="text-sm font-medium text-slate-700">
                                        Reference (referensi) <span class="text-red-500">*</span>
                                    </label>

                                    <div class="flex items-center gap-2">
                                        <span
                                            class="rounded-lg border border-emerald-200 bg-white px-3 py-1.5
                                            text-xs font-semibold text-emerald-800">
                                            Matriks SMKP
                                        </span>

                                        <button type="button" id="openMatrixModal"
                                            class="inline-flex items-center justify-center gap-1.5 rounded-lg
                                            bg-emerald-700 px-3 py-1.5 text-xs font-semibold text-white
                                            transition hover:bg-emerald-800">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                            Pilih Elemen & Subelemen
                                        </button>
                                    </div>
                                </div>

                                <textarea id="matriks" name="matriks" rows="4"
                                    placeholder="Elemen dan subelemen SMKP yang dipilih akan muncul di sini." required class="{{ $input }}">{{ old('matriks') }}</textarea>

                                <p class="mt-2 text-xs text-slate-500">
                                    Klik tombol di atas untuk memilih referensi dari matriks SMKP.
                                </p>

                                @error('matriks')
                                    <p class="{{ $err }}">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div>
                                <label for="description" class="{{ $label }}">
                                    Description (deskripsi temuan)
                                    <span class="text-red-500">*</span>
                                </label>

                                <textarea id="description" name="description" rows="8"
                                    placeholder="Jelaskan secara rinci kondisi atau ketidaksesuaian yang ditemukan saat audit." required
                                    class="{{ $input }}">{{ old('description') }}</textarea>

                                @error('description')
                                    <p class="{{ $err }}">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- Evidence --}}
                        <div>
                            <div class="mb-3 flex items-center justify-between gap-3">
                                <span class="{{ $label }}">Evidence (bukti temuan)</span>

                                <button type="button" id="addEvidence"
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50
                                        px-3 py-2 text-xs font-semibold text-emerald-700
                                        transition hover:bg-emerald-100">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Tambah Bukti
                                </button>
                            </div>

                            <p class="mb-3 text-xs text-slate-500">
                                Keterangan dapat diisi tanpa melampirkan foto atau PDF.
                            </p>

                            <div id="evidenceContainer" class="space-y-4">
                                <div class="evidence-row rounded-xl border border-slate-200 p-4">
                                    <div class="mb-3 flex items-center justify-between">
                                        <span class="text-sm font-semibold text-slate-700">
                                            <span class="evidence-number">Bukti 1</span>
                                        </span>

                                        <button type="button"
                                            class="remove-evidence hidden text-xs font-medium text-red-500
                                                transition hover:text-red-700">
                                            Hapus
                                        </button>
                                    </div>

                                    <div class="space-y-4">
                                        <div>
                                            <label class="{{ $label }}">Keterangan bukti</label>
                                            <textarea name="evidence_captions[]" rows="3" placeholder="Tuliskan keterangan bukti temuan..."
                                                class="{{ $input }}"></textarea>
                                        </div>

                                        <div>
                                            <label class="{{ $label }}">Lampiran (opsional)</label>

                                            <label class="{{ $drop }}">
                                                <span
                                                    class="flex h-11 w-11 shrink-0 items-center justify-center
                                                        rounded-xl bg-emerald-100 text-emerald-700">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15.2 7l-6.5 6.5a2 2 0 102.8 2.8l7-7a4 4 0 00-5.7-5.7l-7 7a6 6 0 008.5 8.5" />
                                                    </svg>
                                                </span>

                                                <span>
                                                    <span class="block text-sm font-semibold text-slate-700">
                                                        Lampirkan bukti temuan
                                                    </span>
                                                    <span class="block text-xs text-slate-500">
                                                        Gambar atau PDF, maksimal 5 MB
                                                    </span>
                                                </span>

                                                <input name="form_files[]" type="file" accept="image/*,.pdf"
                                                    class="sr-only">
                                            </label>

                                            <p class="evidence-file-name mt-2 text-xs text-slate-400">
                                                Belum ada file dipilih.
                                            </p>

                                            <div class="evidence-preview mt-3 hidden"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @error('form_files')
                                <p class="{{ $err }} mt-2">{{ $message }}</p>
                            @enderror
                            @error('form_files.*')
                                <p class="{{ $err }} mt-2">{{ $message }}</p>
                            @enderror
                            @error('evidence_captions.*')
                                <p class="{{ $err }} mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </section>

                {{-- ===== Tindak lanjut ===== --}}
                <section class="{{ $card }}">
                    <div class="{{ $cardHead }} bg-emerald-50/60">
                        <div class="{{ $iconBox }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="9" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12l3 3 5-6" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="{{ $title }}">Managemen Respons (RTL)</h2>
                            <p class="{{ $desc }}">Tindak lanjut perbaikan, diisi oleh auditee.</p>
                        </div>
                    </div>

                    <div class="space-y-5 p-5 sm:p-6">
                        <div>
                            <label for="rtl_response" class="{{ $label }}">Tindakan koreksi</label>
                            <textarea id="rtl_response" name="rtl_response" rows="4"
                                placeholder="Tindakan koreksi dari departemen terkait" class="{{ $input }}">{{ old('rtl_response') }}</textarea>
                            @error('rtl_response')
                                <p class="{{ $err }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <span class="{{ $label }}">Bukti perbaikan</span>
                            <label for="rtl_files" class="{{ $drop }}">
                                <span
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.2 7l-6.5 6.5a2 2 0 102.8 2.8l7-7a4 4 0 00-5.7-5.7l-7 7a6 6 0 008.5 8.5" />
                                    </svg>
                                </span>
                                <span>
                                    <span class="block text-sm font-semibold text-slate-700">Lampirkan bukti
                                        perbaikan</span>
                                    <span class="block text-xs text-slate-500">Gambar atau PDF, boleh lebih dari
                                        satu</span>
                                </span>
                            </label>
                            <input id="rtl_files" name="rtl_files[]" type="file" accept="image/*,.pdf" multiple
                                class="sr-only">
                            <div id="rtl_files_list" class="mt-3 text-xs text-slate-400">Belum ada file dipilih.</div>
                            @error('rtl_files.*')
                                <p class="{{ $err }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <label for="auditee" class="{{ $label }}">Auditee</label>
                                <input type="text" id="auditee" name="auditee" value="{{ old('auditee') }}"
                                    placeholder="Nama penanggung jawab" class="{{ $input }}">
                                @error('auditee')
                                    <p class="{{ $err }}">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="action_days" class="{{ $label }}">Batas waktu tindakan</label>
                                <div class="flex">
                                    <input type="number" id="action_days" name="action_days" min="0"
                                        value="{{ old('action_days', 0) }}"
                                        class="{{ $input }} rounded-r-none">
                                    <span
                                        class="inline-flex items-center rounded-r-xl border border-l-0 border-slate-200 bg-emerald-50 px-4 text-sm font-medium text-emerald-700">hari</span>
                                </div>
                                @error('action_days')
                                    <p class="{{ $err }}">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ===== Verifikasi ===== --}}
                <section class="{{ $card }}">
                    <div class="{{ $cardHead }} bg-amber-50/70">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2">
                                <circle cx="9" cy="8" r="4" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2 21a7 7 0 0112-4.9M16 17l2 2 4-4" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="{{ $title }}">Verifikasi</h2>
                            <p class="{{ $desc }}">Hasil pengecekan lapangan, diisi oleh auditor.</p>
                        </div>
                    </div>

                    <div class="space-y-5 p-5 sm:p-6">
                        <div>
                            <label for="verified_detail" class="{{ $label }}">Hasil verifikasi</label>
                            <textarea id="verified_detail" name="verified_detail" rows="3"
                                placeholder="Hasil verifikasi lapangan setelah perbaikan"
                                class="{{ $input }} focus:border-amber-500 focus:ring-amber-100">{{ old('verified_detail') }}</textarea>
                            @error('verified_detail')
                                <p class="{{ $err }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:max-w-[240px]">
                            <label for="verified_date" class="{{ $label }}">Tanggal verifikasi</label>
                            <input type="date" id="verified_date" name="verified_date"
                                value="{{ old('verified_date') }}"
                                class="{{ $input }} focus:border-amber-500 focus:ring-amber-100">
                            @error('verified_date')
                                <p class="{{ $err }}">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>

                {{-- ===== Aksi (di akhir form) ===== --}}
                <div
                    class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-xs text-slate-500">
                        <span class="text-red-500">*</span> Wajib diisi
                    </p>

                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ url('/findings') }}"
                            class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-emerald-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-emerald-200">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Temuan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Pemilihan Matriks SMKP --}}
    <div id="matrixModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-950/60 p-2 sm:p-5"
        role="dialog" aria-modal="true" aria-labelledby="matrixModalTitle">
        <div
            class="flex max-h-[94vh] w-full max-w-5xl flex-col overflow-hidden
                                rounded-2xl bg-white shadow-2xl">

            {{-- Header --}}
            <div
                class="flex items-center justify-between gap-4 border-b border-slate-200
                                    px-5 py-4 sm:px-7">
                <div>
                    <h2 id="matrixModalTitle" class="text-lg font-bold text-slate-800">
                        Pilih Matriks SMKP
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Centang elemen atau subelemen yang sesuai dengan temuan audit.
                    </p>
                </div>

                <button type="button" id="closeMatrixModal" class="rounded-lg p-2 text-slate-500 hover:bg-slate-100"
                    aria-label="Tutup popup">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Toolbar --}}
            <div
                class="flex flex-wrap items-center justify-between gap-3
                                    border-b border-slate-100 bg-slate-50 px-5 py-3 sm:px-7">
                <span id="matrixSelectedCount" class="text-sm font-medium text-slate-600">
                    0 referensi dipilih
                </span>

                <button type="button" id="clearMatrixSelection"
                    class="text-sm font-semibold text-red-600 hover:text-red-700">
                    Hapus semua centang
                </button>
            </div>

            {{-- Search Matriks SMKP --}}
            <div class="border-b border-slate-200 bg-white px-4 py-3 sm:px-6">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <circle cx="11" cy="11" r="7" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16 16 4 4" />
                    </svg>

                    <input type="search" id="matrixSearch" placeholder="Cari kode atau nama elemen / subelemen..."
                        class="w-full rounded-xl border border-slate-300 bg-slate-50
                                        py-3 pl-10 pr-4 text-sm text-slate-700
                                        placeholder:text-slate-400
                                        focus:border-emerald-500 focus:bg-white
                                        focus:outline-none focus:ring-4 focus:ring-emerald-100"
                        autocomplete="off">
                </div>
            </div>


            {{-- Daftar elemen dalam tabel --}}
            @php
                $elementWeights = [10, 15, 17, 35, 15, 3, 5];

                $leafMaxScore = function ($criteria) use (&$leafMaxScore) {
                    $total = 0;

                    foreach ($criteria as $criterion) {
                        if ($criterion->children->isNotEmpty()) {
                            $total += $leafMaxScore($criterion->children);
                        } else {
                            $total += (int) ($criterion->max_score ?? 0);
                        }
                    }

                    return $total;
                };
            @endphp

            <div class="min-h-0 flex-1 overflow-auto p-4 sm:p-6">
                <div class="overflow-hidden rounded-xl border border-slate-200">
                    <table class="w-full border-collapse text-left">
                        <thead class="sticky top-0 z-10 bg-slate-100">
                            <tr>
                                <th class="w-[65%] px-4 py-3 text-left text-sm font-semibold text-slate-700">
                                    Kriteria / Klausul
                                </th>
                                <th class="w-[17.5%] px-4 py-3 text-center text-sm font-semibold text-slate-700">
                                    Nilai Maks
                                </th>
                                <th class="w-[17.5%] px-4 py-3 text-center text-sm font-semibold text-slate-700">
                                    Bobot Elemen (%)
                                </th>
                            </tr>
                        </thead>

                        @forelse ($elements as $element)
                            @php
                                $elementMax = $leafMaxScore($element->criteria);
                                $weight = $elementWeights[$loop->index] ?? 0;
                            @endphp

                            <tbody class="matrix-element-card"
                                data-search="{{ strtolower($element->code . ' ' . $element->name) }}">
                                <tr class="border-t border-slate-200 bg-emerald-50">
                                    <td class="px-4 py-3">
                                        <label class="flex items-start gap-3">
                                            <input type="checkbox"
                                                class="matrix-element mt-1 h-4 w-4 shrink-0 rounded
                                           border-slate-300 text-emerald-600
                                           focus:ring-emerald-500"
                                                data-element-id="{{ $element->id }}">

                                            <span class="text-sm font-bold text-emerald-950">
                                                {{ $element->code }} — {{ $element->name }}
                                            </span>
                                        </label>
                                    </td>

                                    <td
                                        class="whitespace-nowrap px-4 py-3 text-center text-sm font-bold text-slate-800">
                                        {{ $elementMax }}
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-3 text-center">
                                        <span
                                            class="inline-flex rounded-lg bg-white px-2.5 py-1 text-sm font-bold text-emerald-800 ring-1 ring-emerald-200">
                                            {{ $weight }}%
                                        </span>
                                    </td>
                                </tr>

                                @include('findings.matrix-criteria', [
                                    'criteria' => $element->criteria,
                                    'element' => $element,
                                    'level' => 0,
                                ])
                            </tbody>
                        @empty
                            <tbody>
                                <tr>
                                    <td colspan="3" class="px-4 py-8 text-center text-sm text-slate-500">
                                        Data elemen SMKP belum tersedia atau tidak aktif.
                                    </td>
                                </tr>
                            </tbody>
                        @endforelse
                    </table>
                </div>
            </div>

            {{-- Footer --}}
            <div
                class="flex flex-col-reverse justify-between gap-3 border-t
                                    border-slate-200 bg-white px-5 py-4 sm:flex-row
                                    sm:items-center sm:px-7">
                <p class="text-xs text-slate-500">
                    Pilihan akan dimasukkan ke kolom Reference setelah menekan OK.
                </p>

                <div class="flex justify-end gap-2">
                    <button type="button" id="cancelMatrixModal"
                        class="rounded-lg border border-slate-300 px-4 py-2.5
                                        text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Batal
                    </button>

                    <button type="button" id="confirmMatrixSelection"
                        class="rounded-lg bg-emerald-700 px-5 py-2.5
                                        text-sm font-semibold text-white hover:bg-emerald-800">
                        OK, Gunakan Pilihan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Placeholder mengikuti jenis matriks
        document.getElementById('matrix_type')?.addEventListener('change', function() {
            const labels = {
                smkp: 'Tuliskan elemen, subelemen, atau kriteria SMKP',
                iso: 'Tuliskan nomor klausul dan referensi ISO',
                smk3: 'Tuliskan kriteria atau referensi SMK3'
            };

            const matriks = document.getElementById('matriks');

            if (matriks) {
                matriks.placeholder = labels[this.value] ||
                    'Tuliskan nomor klausul, elemen, atau referensi standar';
            }
        });

        // Tambah/hapus bukti dan tampilkan preview file
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('evidenceContainer');
            const addButton = document.getElementById('addEvidence');

            if (container && addButton) {
                function updateEvidenceRows() {
                    const rows = container.querySelectorAll('.evidence-row');

                    rows.forEach((row, index) => {
                        row.querySelector('.evidence-number').textContent =
                            'Bukti ' + (index + 1);

                        row.querySelector('.remove-evidence')
                            .classList.toggle('hidden', rows.length === 1);
                    });
                }

                function clearPreview(row) {
                    const preview = row.querySelector('.evidence-preview');

                    if (!preview) return;

                    preview.querySelectorAll('img[data-object-url]').forEach(img => {
                        URL.revokeObjectURL(img.dataset.objectUrl);
                    });

                    preview.innerHTML = '';
                    preview.classList.add('hidden');
                }

                function showPreview(row, file) {
                    const preview = row.querySelector('.evidence-preview');
                    const fileName = row.querySelector('.evidence-file-name');

                    clearPreview(row);

                    if (!file) {
                        fileName.textContent = 'Belum ada file dipilih.';
                        fileName.classList.remove('text-slate-700');
                        fileName.classList.add('text-slate-400');
                        return;
                    }

                    fileName.textContent = file.name;
                    fileName.classList.remove('text-slate-400');
                    fileName.classList.add('text-slate-700');

                    preview.classList.remove('hidden');

                    if (file.type.startsWith('image/')) {
                        const image = document.createElement('img');
                        const objectUrl = URL.createObjectURL(file);

                        image.src = objectUrl;
                        image.dataset.objectUrl = objectUrl;
                        image.alt = 'Preview ' + file.name;
                        image.className =
                            'max-h-64 max-w-full rounded-xl border border-slate-200 object-contain';

                        preview.appendChild(image);
                    } else if (file.type === 'application/pdf' ||
                        file.name.toLowerCase().endsWith('.pdf')) {
                        const pdfBox = document.createElement('div');

                        pdfBox.className =
                            'flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-3';

                        pdfBox.innerHTML = `
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center
                            rounded-lg bg-red-50 text-xs font-bold text-red-600">
                            PDF
                        </span>
                        <span class="min-w-0">
                            <span class="block text-sm font-medium text-slate-700">
                                Dokumen PDF dipilih
                            </span>
                            <span class="block break-all text-xs text-slate-500"></span>
                        </span>
                    `;

                        pdfBox.querySelectorAll('span')[2].textContent = file.name;
                        preview.appendChild(pdfBox);
                    }

                    if (!preview.children.length) {
                        preview.classList.add('hidden');
                    }
                }

                addButton.addEventListener('click', function() {
                    const firstRow = container.querySelector('.evidence-row');
                    if (!firstRow) return;

                    const newRow = firstRow.cloneNode(true);

                    newRow.querySelector('textarea').value = '';
                    newRow.querySelector('input[type="file"]').value = '';
                    newRow.querySelector('.evidence-file-name').textContent =
                        'Belum ada file dipilih.';

                    newRow.querySelector('.evidence-file-name')
                        .classList.remove('text-slate-700');

                    newRow.querySelector('.evidence-file-name')
                        .classList.add('text-slate-400');

                    const preview = newRow.querySelector('.evidence-preview');
                    preview.innerHTML = '';
                    preview.classList.add('hidden');

                    container.appendChild(newRow);
                    updateEvidenceRows();
                });

                container.addEventListener('change', function(event) {
                    if (!event.target.matches('input[type="file"]')) return;

                    const row = event.target.closest('.evidence-row');
                    const file = event.target.files[0] || null;

                    showPreview(row, file);
                });

                container.addEventListener('click', function(event) {
                    const button = event.target.closest('.remove-evidence');
                    if (!button) return;

                    const row = button.closest('.evidence-row');
                    clearPreview(row);
                    row.remove();

                    updateEvidenceRows();
                });

                updateEvidenceRows();
            }

            // Modal pemilihan elemen dan kriteria matriks
            const modal = document.getElementById('matrixModal');
            const openButton = document.getElementById('openMatrixModal');
            const closeButton = document.getElementById('closeMatrixModal');
            const cancelButton = document.getElementById('cancelMatrixModal');
            const confirmButton = document.getElementById('confirmMatrixSelection');
            const clearButton = document.getElementById('clearMatrixSelection');
            const textarea = document.getElementById('matriks');
            const selectedCount = document.getElementById('matrixSelectedCount');

            if (!modal || !openButton || !textarea) return;

            const criterionBoxes = () => [...modal.querySelectorAll('.matrix-criterion')];

            const elementBoxes = () => [...modal.querySelectorAll('.matrix-element')];

            function updateCount() {
                const count = criterionBoxes().filter(box => box.checked).length;

                if (selectedCount) {
                    selectedCount.textContent = `${count} referensi dipilih`;
                }

                elementBoxes().forEach(elementBox => {
                    const related = criterionBoxes().filter(
                        box => box.dataset.elementId === elementBox.dataset.elementId
                    );

                    elementBox.checked =
                        related.length > 0 && related.every(box => box.checked);

                    elementBox.indeterminate =
                        related.some(box => box.checked) && !elementBox.checked;
                });
            }

            function openModal() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }

            openButton.addEventListener('click', openModal);
            closeButton?.addEventListener('click', closeModal);
            cancelButton?.addEventListener('click', closeModal);

            modal.addEventListener('click', function(event) {
                if (event.target === modal) closeModal();
            });

            elementBoxes().forEach(elementBox => {
                elementBox.addEventListener('change', function() {
                    criterionBoxes()
                        .filter(box =>
                            box.dataset.elementId === elementBox.dataset.elementId
                        )
                        .forEach(box => {
                            box.checked = elementBox.checked;
                        });

                    updateCount();
                });
            });

            criterionBoxes().forEach(box => {
                box.addEventListener('change', updateCount);
            });

            clearButton?.addEventListener('click', function() {
                criterionBoxes().forEach(box => {
                    box.checked = false;
                });

                updateCount();
            });

            confirmButton?.addEventListener('click', function() {
                const grouped = new Map();

                criterionBoxes()
                    .filter(box => box.checked)
                    .forEach(box => {
                        const elementLabel = box.dataset.elementLabel;

                        if (!grouped.has(elementLabel)) {
                            grouped.set(elementLabel, []);
                        }

                        grouped.get(elementLabel).push(box.dataset.value);
                    });

                const referenceText = [...grouped.entries()]
                    .map(([element, criteria]) =>
                        `${element}\n${criteria.map(item => `- ${item}`).join('\n')}`
                    )
                    .join('\n\n');

                textarea.value = referenceText;
                textarea.dispatchEvent(new Event('input', {
                    bubbles: true
                }));

                closeModal();
            });

            const matrixSearch = document.getElementById('matrixSearch');

            matrixSearch?.addEventListener('input', function() {
                const keyword = this.value.trim().toLowerCase();

                document.querySelectorAll('.matrix-element-card').forEach(card => {
                    const elementText = card.dataset.search || '';
                    const rows = [...card.querySelectorAll('.matrix-criterion-row')];
                    let hasMatch = elementText.includes(keyword);

                    rows.forEach(row => {
                        const matches = (row.dataset.value || '').includes(keyword);

                        if (matches) hasMatch = true;

                        row.classList.toggle(
                            'hidden',
                            keyword !== '' && !matches
                        );
                    });

                    card.classList.toggle(
                        'hidden',
                        keyword !== '' && !hasMatch
                    );
                });
            });

            updateCount();
        });
    </script>
</x-app-layout>

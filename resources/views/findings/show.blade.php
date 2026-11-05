<x-app-layout>
    <div class="min-h-screen bg-slate-50 px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            @php
                $evidenceFiles = $finding->evidence_files ?? [];
                $evidenceCaptions = $finding->evidence_captions ?? [];
                $rtlFiles = $finding->rtl_files ?? [];
                $rtlCaptions = $finding->rtl_file_captions ?? [];

                $evidenceFiles = is_array($evidenceFiles) ? $evidenceFiles : (json_decode($evidenceFiles, true) ?: []);

                $evidenceCaptions = is_array($evidenceCaptions)
                    ? $evidenceCaptions
                    : (json_decode($evidenceCaptions, true) ?:
                    []);

                $rtlFiles = is_array($rtlFiles) ? $rtlFiles : (json_decode($rtlFiles, true) ?: []);

                $rtlCaptions = is_array($rtlCaptions) ? $rtlCaptions : (json_decode($rtlCaptions, true) ?: []);
            @endphp

            {{-- HEADER --}}
            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">
                        Detail Temuan Audit
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Informasi lengkap temuan hasil audit SMKP.
                    </p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('findings.index') }}"
                        class="rounded-xl border border-slate-300 bg-white px-4 py-2.5
                           text-sm font-semibold text-slate-700 hover:bg-slate-100">
                        Kembali
                    </a>

                    <a href="{{ route('findings.edit', $finding->id) }}"
                        class="rounded-xl bg-emerald-600 px-4 py-2.5
                           text-sm font-semibold text-white hover:bg-emerald-700">
                        Edit Temuan
                    </a>
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
        'Kriteria' => $finding->finding_criteria,
        'Kategori' => $finding->finding_category,
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

            {{-- PLOR --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-5 py-4">
                    <h3 class="font-semibold text-slate-800">
                        Uraian Temuan (PLOR)
                    </h3>
                </div>

                <div class="space-y-5 p-5">
                    @foreach ([
                                'Problem' => $finding->problem,
                                'Location' => $finding->area_temuan,
                                'Description' => $finding->description,
                                'Reference' => $finding->matriks,
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

            {{-- BUKTI TEMUAN AWAL --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 16l4-4a2 2 0 012.8 0l4.2 4m-2-2l1.2-1.2a2 2 0 012.8 0L20 16M5 20h14a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="font-semibold text-slate-800">
                            Bukti Temuan Awal
                        </h3>
                        <p class="text-xs text-slate-500">
                            Dokumentasi bukti audit PLOR
                        </p>
                    </div>
                </div>

                <div class="p-5">
                    @if (count($evidenceFiles))
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($evidenceFiles as $index => $file)
                                @php
                                    $fileUrl = asset('storage/' . $file);
                                    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                    $caption = $evidenceCaptions[$index] ?? '';
                                    $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'webp']);
                                    $isPdf = $extension === 'pdf';
                                @endphp

                                <div class="overflow-hidden rounded-xl border border-slate-200 bg-white">
                                    @if ($isImage)
                                        <a href="{{ $fileUrl }}" target="_blank" rel="noopener noreferrer">
                                            <img src="{{ $fileUrl }}" alt="{{ $caption ?: 'Bukti temuan awal' }}"
                                                class="h-52 w-full bg-slate-100 object-cover transition duration-200 hover:opacity-90"
                                                loading="lazy">
                                        </a>
                                    @elseif ($isPdf)
                                        <a href="{{ $fileUrl }}" target="_blank" rel="noopener noreferrer"
                                            class="flex h-40 flex-col items-center justify-center gap-3 bg-rose-50 text-rose-700 transition hover:bg-rose-100">
                                            <svg class="h-12 w-12" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7 3h7l5 5v12a1 1 0 01-1 1H6a1 1 0 01-1-1V4a1 1 0 011-1h1zm7 0v5h5M8 13h8M8 17h5" />
                                            </svg>
                                            <span class="text-sm font-bold">DOKUMEN PDF</span>
                                        </a>
                                    @else
                                        <div
                                            class="flex h-40 items-center justify-center bg-slate-100 text-sm text-slate-500">
                                            File lampiran
                                        </div>
                                    @endif

                                    <div class="space-y-3 p-3">
                                        <div>
                                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                                Keterangan Bukti
                                            </p>
                                            <p class="mt-1 whitespace-pre-line break-words text-sm text-slate-700">
                                                {{ filled($caption) ? $caption : 'Tidak ada keterangan.' }}
                                            </p>
                                        </div>

                                        <a href="{{ $fileUrl }}" target="_blank" rel="noopener noreferrer"
                                            class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-700 hover:text-emerald-800">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14 3h7v7m-11 4L21 3M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6" />
                                            </svg>
                                            Buka file
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-8 text-center">
                            <p class="text-sm text-slate-500">
                                Belum ada bukti temuan awal yang dilampirkan.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- RENCANA TINDAK LANJUT --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-5 py-4">
                    <h3 class="font-semibold text-slate-800">
                        Rencana Tindak Lanjut (RTL)
                    </h3>
                </div>

                <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <p class="mb-2 text-sm font-semibold text-slate-700">
                            Tanggapan / Rencana Perbaikan
                        </p>
                        <div
                            class="whitespace-pre-line break-words rounded-xl
                                bg-slate-50 p-4 text-sm leading-6 text-slate-600">
                            {{ filled($finding->rtl_response) ? $finding->rtl_response : '-' }}
                        </div>
                    </div>

                    <div>
                        <p class="mb-1 text-xs font-medium uppercase tracking-wide text-slate-500">
                            Auditee
                        </p>
                        <p class="text-sm font-semibold text-slate-800">
                            {{ $finding->auditee ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="mb-1 text-xs font-medium uppercase tracking-wide text-slate-500">
                            Batas Waktu (Hari)
                        </p>
                        <p class="text-sm font-semibold text-slate-800">
                            {{ $finding->action_days ?? '-' }}
                        </p>
                    </div>
                </div>


                {{-- BUKTI PERBAIKAN RTL --}}
                <div class="border-t border-slate-100 p-5">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.2 7l-6.5 6.5a2 2 0 102.8 2.8l7-7a4 4 0 00-5.7-5.7l-7 7a6 6 0 008.5 8.5" />
                            </svg>
                        </div>

                        <div>
                            <h4 class="font-semibold text-slate-800">
                                Bukti Perbaikan
                            </h4>
                            <p class="text-xs text-slate-500">
                                Dokumentasi tindak lanjut dari auditee
                            </p>
                        </div>
                    </div>

                    @if (count($rtlFiles))
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($rtlFiles as $index => $file)
                                @php
                                    $fileUrl = asset('storage/' . $file);
                                    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                    $caption = $rtlCaptions[$index] ?? '';
                                    $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'webp']);
                                    $isPdf = $extension === 'pdf';
                                @endphp

                                <div class="overflow-hidden rounded-xl border border-slate-200 bg-white">
                                    @if ($isImage)
                                        <a href="{{ $fileUrl }}" target="_blank" rel="noopener noreferrer">
                                            <img src="{{ $fileUrl }}"
                                                alt="{{ $caption ?: 'Bukti perbaikan RTL' }}"
                                                class="h-52 w-full bg-slate-100 object-cover transition duration-200 hover:opacity-90"
                                                loading="lazy">
                                        </a>
                                    @elseif ($isPdf)
                                        <a href="{{ $fileUrl }}" target="_blank" rel="noopener noreferrer"
                                            class="flex h-40 flex-col items-center justify-center gap-3 bg-rose-50 text-rose-700 transition hover:bg-rose-100">
                                            <svg class="h-12 w-12" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7 3h7l5 5v12a1 1 0 01-1 1H6a1 1 0 01-1-1V4a1 1 0 011-1h1zm7 0v5h5M8 13h8M8 17h5" />
                                            </svg>
                                            <span class="text-sm font-bold">DOKUMEN PDF</span>
                                        </a>
                                    @else
                                        <div
                                            class="flex h-40 items-center justify-center bg-slate-100 text-sm text-slate-500">
                                            File lampiran
                                        </div>
                                    @endif

                                    <div class="space-y-3 p-3">
                                        <div>
                                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                                Keterangan Bukti
                                            </p>
                                            <p class="mt-1 whitespace-pre-line break-words text-sm text-slate-700">
                                                {{ filled($caption) ? $caption : 'Tidak ada keterangan.' }}
                                            </p>
                                        </div>

                                        <a href="{{ $fileUrl }}" target="_blank" rel="noopener noreferrer"
                                            class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:text-blue-800">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14 3h7v7m-11 4L21 3M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6" />
                                            </svg>
                                            Buka file
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div
                            class="rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-8 text-center">
                            <p class="text-sm text-slate-500">
                                Belum ada bukti perbaikan yang dilampirkan.
                            </p>
                        </div>
                    @endif
                </div>

            </div>

            {{-- VERIFIKASI --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-5 py-4">
                    <h3 class="font-semibold text-slate-800">
                        Verifikasi
                    </h3>
                </div>

                <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <p class="mb-2 text-sm font-semibold text-slate-700">
                            Detail Verifikasi
                        </p>
                        <div
                            class="whitespace-pre-line break-words rounded-xl
                                bg-slate-50 p-4 text-sm leading-6 text-slate-600">
                            {{ filled($finding->verified_detail) ? $finding->verified_detail : '-' }}
                        </div>
                    </div>

                    <div>
                        <p class="mb-1 text-xs font-medium uppercase tracking-wide text-slate-500">
                            Tanggal Verifikasi
                        </p>
                        <p class="text-sm font-semibold text-slate-800">
                            {{ $finding->verified_date?->format('d/m/Y') ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

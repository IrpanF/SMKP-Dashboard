<x-app-layout>
    <div class="min-h-screen bg-slate-50 px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            <div class="mb-6">
                <a href="{{ route('verification.index') }}"
                    class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">
                    &larr; Kembali ke daftar verifikasi
                </a>

                <h2 class="mt-3 text-2xl font-bold text-slate-800">
                    Verifikasi Temuan {{ $finding->finding_no }}
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Periksa tanggapan RTL dan bukti perbaikan sebelum mengambil keputusan.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- INFORMASI TEMUAN --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-5 py-4">
                    <h3 class="font-semibold text-slate-800">
                        Informasi Temuan
                    </h3>
                </div>

                <div class="space-y-4 p-5">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Lokasi Temuan
                        </p>
                        <p class="mt-1 text-sm font-semibold text-slate-800">
                            {{ $finding->location_name ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-slate-700">Problem</p>
                        <div
                            class="mt-2 whitespace-pre-line rounded-xl bg-slate-50 p-4 text-sm leading-6 text-slate-600">
                            {{ $finding->problem ?: '-' }}
                        </div>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-slate-700">Recommendation</p>
                        <div
                            class="mt-2 whitespace-pre-line rounded-xl bg-slate-50 p-4 text-sm leading-6 text-slate-600">
                            {{ $finding->recommendation ?: '-' }}
                        </div>
                    </div>
                </div>
            </div>


            {{-- RTL LENGKAP --}}
            @php
                $rtlFiles = $finding->rtl_files ?? [];
                $rtlCaptions = $finding->rtl_file_captions ?? [];

                if (is_string($rtlFiles)) {
                    $rtlFiles = json_decode($rtlFiles, true) ?: [];
                }

                if (is_string($rtlCaptions)) {
                    $rtlCaptions = json_decode($rtlCaptions, true) ?: [];
                }

                $rtlFiles = is_array($rtlFiles) ? array_values($rtlFiles) : [];
                $rtlCaptions = is_array($rtlCaptions) ? $rtlCaptions : [];

                $statusLabels = [
                    'open' => 'Belum Dikerjakan',
                    'in_progress' => 'Sedang Dikerjakan',
                    'revision_required' => 'Perlu Revisi',
                    'pending_verification' => 'Menunggu Verifikasi',
                    'closed' => 'Selesai',
                ];

                $currentStatus = $finding->status ?? '';
            @endphp

            <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- HEADER --}}
                <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-4 sm:px-6">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-7 8l2 2 4-4" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="font-bold text-slate-800">
                            Rencana Tindak Lanjut (RTL)
                        </h3>
                        <p class="mt-0.5 text-xs text-slate-500">
                            Informasi lengkap tanggapan dan rencana perbaikan dari auditee.
                        </p>
                    </div>
                </div>

                <div class="space-y-6 p-5 sm:p-6">

                    {{-- STATUS RTL --}}
                    <div class="rounded-xl border border-emerald-100 bg-emerald-50/70 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">
                            Status Tindak Lanjut
                        </p>

                        <span
                            class="mt-2 inline-flex rounded-full border border-emerald-200 bg-white px-3 py-1 text-xs font-semibold text-emerald-700">
                            {{ $statusLabels[$currentStatus] ?? ($currentStatus ? ucfirst(str_replace('_', ' ', $currentStatus)) : 'Belum ada status') }}
                        </span>
                    </div>

                    {{-- INFORMASI RTL --}}
                    <div class="grid gap-5 sm:grid-cols-2">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Fungsi
                            </p>
                            <p class="mt-2 text-sm leading-6 text-slate-800">
                                {{ $finding->function_name ?: '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Auditee / Penanggung Jawab
                            </p>
                            <p class="mt-2 text-sm leading-6 text-slate-800">
                                {{ $finding->auditee ?: '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Batas Waktu Perbaikan
                            </p>
                            <p class="mt-2 text-sm font-semibold text-slate-800">
                                @if ($finding->action_days !== null)
                                    {{ $finding->action_days }} hari
                                @else
                                    -
                                @endif
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Jumlah Bukti Perbaikan
                            </p>
                            <p class="mt-2 text-sm font-semibold text-slate-800">
                                {{ count($rtlFiles) }} file
                            </p>
                        </div>

                    </div>

                    {{-- ROOT CAUSE --}}
                    <div>
                        <div class="mb-2 flex items-center gap-2">
                            <span
                                class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-100 text-amber-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3m0 4h.01M10.3 3.9L1.8 18.6A1.5 1.5 0 003.1 21h17.8a1.5 1.5 0 001.3-2.4L13.7 3.9a2 2 0 00-3.4 0z" />
                                </svg>
                            </span>
                            <h4 class="text-sm font-bold text-slate-800">
                                Root Cause (Akar Penyebab)
                            </h4>
                        </div>

                        <div
                            class="whitespace-pre-line rounded-xl border border-slate-200 bg-slate-50 p-4 text-sm leading-7 text-slate-700">
                            {{ $finding->root_cause ?: '-' }}</div>
                    </div>

                    {{-- TANGGAPAN RTL --}}
                    <div>
                        <div class="mb-2 flex items-center gap-2">
                            <span
                                class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-100 text-emerald-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 10h8M8 14h5m-8 6l3-3h9a3 3 0 003-3V6a3 3 0 00-3-3H7a3 3 0 00-3 3v11l1 3z" />
                                </svg>
                            </span>
                            <h4 class="text-sm font-bold text-slate-800">
                                Tanggapan / Rencana Perbaikan
                            </h4>
                        </div>

                        <div
                            class="whitespace-pre-line rounded-xl border border-slate-200 bg-slate-50 p-4 text-sm leading-7 text-slate-700">
                            {{ $finding->rtl_response ?: '-' }}</div>
                    </div>

                    {{-- BUKTI PERBAIKAN --}}
                    <div>
                        <div class="mb-3 flex flex-wrap items-center justify-between gap-2">
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">
                                    Bukti Perbaikan
                                </h4>
                                <p class="mt-1 text-xs text-slate-500">
                                    Klik file untuk melihat bukti yang diunggah auditee.
                                </p>
                            </div>

                            <span class="rounded-lg bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                {{ count($rtlFiles) }} file
                            </span>
                        </div>

                        @if (count($rtlFiles))
                            <div class="grid gap-4 sm:grid-cols-2">

                                @foreach ($rtlFiles as $index => $file)
                                    @php
                                        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'webp']);
                                        $caption = $rtlCaptions[$index] ?? '';
                                    @endphp

                                    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white">

                                        {{-- PREVIEW --}}
                                        <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                            rel="noopener noreferrer" class="group block bg-slate-50">

                                            @if ($isImage)
                                                <img src="{{ asset('storage/' . $file) }}"
                                                    alt="Bukti perbaikan {{ $index + 1 }}" loading="lazy"
                                                    class="h-52 w-full object-contain transition group-hover:opacity-90">
                                            @else
                                                <div class="flex h-40 flex-col items-center justify-center gap-3">
                                                    <svg class="h-12 w-12 text-red-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M7 3h7l5 5v13H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14 3v5h5M8 15h8M8 18h6" />
                                                    </svg>
                                                    <span class="text-xs font-bold uppercase text-red-600">
                                                        {{ $extension ?: 'File' }}
                                                    </span>
                                                </div>
                                            @endif
                                        </a>

                                        {{-- DETAIL FILE --}}
                                        <div class="space-y-2 border-t border-slate-100 p-4">
                                            <p class="break-all text-xs font-semibold text-slate-700">
                                                Bukti {{ $index + 1 }} — {{ basename($file) }}
                                            </p>

                                            <div>
                                                <p class="text-xs font-semibold text-slate-500">
                                                    Keterangan Bukti
                                                </p>

                                                <p class="mt-1 whitespace-pre-line text-sm leading-6 text-slate-700">
                                                    {{ is_string($caption) && trim($caption) !== '' ? $caption : 'Tidak ada keterangan.' }}
                                                </p>
                                            </div>

                                            <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                rel="noopener noreferrer"
                                                class="inline-flex items-center gap-1.5 pt-1 text-xs font-semibold text-emerald-700 hover:text-emerald-800">
                                                Lihat / Buka File
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M7 17L17 7M8 7h9v9" />
                                                </svg>
                                            </a>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        @else
                            <div
                                class="rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-8 text-center">
                                <p class="text-sm font-medium text-slate-600">
                                    Belum ada bukti perbaikan yang diunggah.
                                </p>
                                <p class="mt-1 text-xs text-slate-400">
                                    Auditee perlu melengkapi bukti sebelum perbaikan dapat diverifikasi.
                                </p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            {{-- FORM KEPUTUSAN --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-5 py-4">
                    <h3 class="font-semibold text-slate-800">
                        Keputusan Auditor
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Isi catatan verifikasi sebelum menyetujui atau meminta revisi.
                    </p>
                </div>

                <div class="space-y-5 p-5">
                    <form id="approve-form" action="{{ route('verification.approve', $finding->id) }}"
                        method="POST">
                        @csrf
                        <label for="approve-detail" class="mb-2 block text-sm font-medium text-slate-700">
                            Catatan Verifikasi
                        </label>

                        <textarea id="approve-detail" name="verified_detail" rows="4" required maxlength="5000"
                            class="w-full rounded-xl border border-slate-200 px-3.5 py-3 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
                            placeholder="Tuliskan hasil pemeriksaan dan alasan keputusan...">{{ old('verified_detail') }}</textarea>

                        <div class="mt-4 flex flex-wrap gap-3">
                            <button type="submit"
                                class="rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-700">
                                Setujui Perbaikan
                            </button>
                        </div>
                    </form>

                    <div class="border-t border-slate-100 pt-5">
                        <form action="{{ route('verification.revision', $finding->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin meminta revisi kepada auditee?')">
                            @csrf

                            <label for="revision-detail" class="mb-2 block text-sm font-medium text-slate-700">
                                Catatan Revisi
                            </label>

                            <textarea id="revision-detail" name="verified_detail" rows="4" required maxlength="5000"
                                class="w-full rounded-xl border border-slate-200 px-3.5 py-3 text-sm focus:border-amber-500 focus:ring-4 focus:ring-amber-100"
                                placeholder="Jelaskan bagian yang perlu diperbaiki oleh auditee...">{{ old('verified_detail') }}</textarea>

                            <button type="submit"
                                class="mt-4 rounded-xl border border-amber-300 bg-amber-50 px-5 py-2.5 text-sm font-semibold text-amber-800 hover:bg-amber-100">
                                Minta Revisi
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

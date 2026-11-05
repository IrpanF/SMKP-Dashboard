@section('title', 'SMKP UTSG - RTL')

<x-app-layout>
    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-slate-800">
                    Tindak Lanjut Temuan
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Daftar temuan audit SMKP dan progres tindak lanjut perbaikan.
                </p>
            </div>

            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))
                <div
                    class="mb-5 rounded-lg border border-emerald-200
                            bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- SUMMARY --}}
            @php
                $totalTemuan = $findings->count();
                $belumDikerjakan = $findings->where('status', 'open')->count();
                $menungguVerifikasi = $findings->where('status', 'pending_verification')->count();
                $selesai = $findings->where('status', 'closed')->count();

                $statusLabels = [
                    'open' => 'Belum Dikerjakan',
                    'in_progress' => 'Sedang Dikerjakan',
                    'pending_verification' => 'Menunggu Verifikasi',
                    'revision_required' => 'Perlu Revisi',
                    'closed' => 'Selesai',
                ];

                $statusColors = [
                    'open' => 'bg-slate-100 text-slate-700',
                    'in_progress' => 'bg-blue-100 text-blue-700',
                    'pending_verification' => 'bg-amber-100 text-amber-700',
                    'revision_required' => 'bg-red-100 text-red-700',
                    'closed' => 'bg-emerald-100 text-emerald-700',
                ];
            @endphp

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="rounded-xl border border-slate-200 bg-white p-4">
                    <p class="text-sm text-slate-500">Total Temuan</p>
                    <p class="mt-2 text-2xl font-bold text-slate-800">
                        {{ $totalTemuan }}
                    </p>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-4">
                    <p class="text-sm text-slate-500">Belum Dikerjakan</p>
                    <p class="mt-2 text-2xl font-bold text-slate-600">
                        {{ $belumDikerjakan }}
                    </p>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-4">
                    <p class="text-sm text-slate-500">Menunggu Verifikasi</p>
                    <p class="mt-2 text-2xl font-bold text-amber-600">
                        {{ $menungguVerifikasi }}
                    </p>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-4">
                    <p class="text-sm text-slate-500">Selesai</p>
                    <p class="mt-2 text-2xl font-bold text-emerald-600">
                        {{ $selesai }}
                    </p>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                <div
                    class="flex flex-col gap-3 border-b border-slate-200
                            px-5 py-4 sm:flex-row sm:items-center
                            sm:justify-between">
                    <div>
                        <h2 class="font-semibold text-slate-800">
                            Data Temuan Audit
                        </h2>
                        <p class="mt-1 text-xs text-slate-500">
                            Total {{ $totalTemuan }} data temuan
                        </p>
                    </div>
                </div>

                @if ($findings->isEmpty())
                    <div class="px-6 py-16 text-center">
                        <div class="mb-3 flex justify-center text-slate-300">
                            <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-700">
                            Belum ada temuan
                        </h3>
                        <p class="mt-1 text-sm text-slate-500">
                            Temuan audit akan ditampilkan di tabel ini.
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-[1050px] w-full text-left text-sm">

                            <thead
                                class="bg-slate-50 text-xs uppercase
                                          tracking-wider text-slate-500">
                                <tr>
                                    <th class="px-5 py-4 font-semibold">No.</th>
                                    <th class="px-5 py-4 font-semibold">Nomor Temuan</th>
                                    <th class="px-5 py-4 font-semibold">Tanggal Audit</th>
                                    <th class="px-5 py-4 font-semibold">Lokasi</th>
                                    <th class="px-5 py-4 font-semibold">Kategori</th>
                                    <th class="px-5 py-4 font-semibold">Uraian Temuan</th>
                                    <th class="px-5 py-4 font-semibold">Target RTL</th>
                                    <th class="px-5 py-4 font-semibold">Status</th>
                                    <th class="px-5 py-4 text-center font-semibold">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @foreach ($findings as $finding)
                                    @php
                                        $status = $finding->status ?? 'open';
                                    @endphp

                                    <tr class="transition hover:bg-slate-50/80">

                                        <td class="px-5 py-4 text-slate-500">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-5 py-4">
                                            <span class="font-semibold text-slate-800">
                                                {{ $finding->finding_no }}
                                            </span>
                                            <p class="mt-1 text-xs text-slate-400">
                                                {{ $finding->form_no ?? '-' }}
                                            </p>
                                        </td>

                                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                            {{ $finding->audit_date ? $finding->audit_date->format('d/m/Y') : '-' }}
                                        </td>

                                        <td class="px-5 py-4 text-slate-600">
                                            {{ $finding->location_name ?? '-' }}
                                        </td>

                                        <td class="px-5 py-4">
                                            @php
                                                $categoryColors = [
                                                    'mayor' => 'bg-red-50 text-red-700',
                                                    'minor' => 'bg-amber-50 text-amber-700',
                                                    'observasi' => 'bg-blue-50 text-blue-700',
                                                    'ofi' => 'bg-blue-50 text-blue-700',
                                                ];

                                                $category = strtolower($finding->finding_category ?? '');
                                            @endphp

                                            <span
                                                class="inline-flex rounded-md px-2.5 py-1
                                                text-xs font-semibold
                                                {{ $categoryColors[$category] ?? 'bg-slate-100 text-slate-600' }}">
                                                {{ $finding->finding_category ? ucfirst($finding->finding_category) : '-' }}
                                            </span>
                                        </td>

                                        <td class="max-w-xs px-5 py-4 text-slate-600">
                                            <p class="line-clamp-2" title="{{ $finding->problem }}">
                                                {{ \Illuminate\Support\Str::limit($finding->problem ?? '-', 100) }}
                                            </p>
                                        </td>

                                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                            {{ $finding->action_days > 0 ? $finding->action_days . ' hari' : 'Belum ditentukan' }}
                                        </td>

                                        <td class="px-5 py-4">
                                            <span
                                                class="inline-flex whitespace-nowrap
                                                rounded-full px-2.5 py-1 text-xs
                                                font-semibold
                                                {{ $statusColors[$status] ?? 'bg-slate-100 text-slate-700' }}">
                                                {{ $statusLabels[$status] ?? $status }}
                                            </span>
                                        </td>

                                        <td class="px-5 py-4 text-center">
                                            @if (in_array($status, ['open', 'in_progress', 'revision_required', 'pending_verification'], true))
                                                <a href="{{ route('rtl.edit', $finding->id) }}"
                                                    class="inline-flex items-center justify-center whitespace-nowrap rounded-lg
                                                        bg-emerald-600 px-3 py-2 text-xs font-semibold text-white
                                                        transition hover:bg-emerald-700">
                                                    @if ($status === 'revision_required')
                                                        Perbaiki RTL
                                                    @elseif ($status === 'pending_verification')
                                                        Edit RTL
                                                    @elseif ($status === 'in_progress')
                                                        Edit RTL
                                                    @else
                                                        Isi RTL
                                                    @endif
                                                </a>
                                            @else
                                                <span class="text-xs font-medium text-emerald-700">
                                                    Selesai
                                                </span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <div
                        class="border-t border-slate-200 bg-slate-50
                                px-5 py-3 text-xs text-slate-500">
                        Menampilkan {{ $findings->count() }} temuan audit.
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

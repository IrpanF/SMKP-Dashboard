@section('title', 'SMKP UTSG - Users')

<x-app-layout>
    <div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        Manajemen Users
                    </h1>
                    <p class="mt-1 text-sm text-slate-500">
                        Kelola akun admin, auditor, dan auditee.
                    </p>
                </div>

                <a href="{{ route('users.create') }}"
                   class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    + Tambah User
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">No.</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Nama</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">No. Pegawai</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Email</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Role</th>
                                <th class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($users as $user)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4">
                                        <div class="font-semibold text-slate-800">
                                            {{ $user->name }}
                                        </div>
                                        @if ($user->id === auth()->id())
                                            <span class="text-xs text-emerald-600">Akun kamu</span>
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-sm font-medium text-slate-700">
                                        {{ $user->employee_number }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                        {{ $user->email }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4">
                                        @php
                                            $roleClasses = [
                                                'admin' => 'bg-purple-100 text-purple-700',
                                                'auditor' => 'bg-blue-100 text-blue-700',
                                                'auditee' => 'bg-amber-100 text-amber-700',
                                            ];
                                        @endphp

                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $roleClasses[$user->role] ?? 'bg-slate-100 text-slate-600' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('users.edit', $user) }}"
                                               class="rounded-lg border border-blue-200 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-50">
                                                Edit
                                            </a>

                                            @if ($user->id !== auth()->id())
                                                <form action="{{ route('users.destroy', $user) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin menghapus user {{ addslashes($user->name) }}?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="rounded-lg border border-rose-200 px-3 py-2 text-xs font-semibold text-rose-700 transition hover:bg-rose-50">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-5 py-12 text-center">
                                        <p class="font-semibold text-slate-600">Belum ada data user.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-slate-100 px-5 py-4">
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

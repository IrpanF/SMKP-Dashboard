<x-app-layout>
    <div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6">
        <div class="mx-auto max-w-3xl">
            <a href="{{ route('users.index') }}"
               class="text-sm font-medium text-emerald-700 hover:text-emerald-800">
                ← Kembali ke Users
            </a>

            <div class="mt-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <h1 class="text-2xl font-bold text-slate-800">Edit User</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Perbarui informasi akun {{ $user->name }}.
                </p>

                @if ($errors->any())
                    <div class="mt-5 rounded-xl bg-rose-50 p-4 text-sm text-rose-700">
                        <ul class="list-inside list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.update', $user) }}" method="POST" class="mt-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Nama Lengkap</label>
                        <input name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Nomor Pegawai</label>
                        <input name="employee_number"
                               value="{{ old('employee_number', $user->employee_number) }}"
                               type="text" inputmode="numeric" pattern="[0-9]{5}"
                               maxlength="5" minlength="5" required
                               class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <p class="mt-1 text-xs text-slate-500">Harus terdiri dari 5 digit angka.</p>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Email</label>
                        <input name="email" type="email" value="{{ old('email', $user->email) }}" required
                               class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Role</label>
                        <select name="role" required
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                            <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                            <option value="auditor" @selected(old('role', $user->role) === 'auditor')>Auditor</option>
                            <option value="auditee" @selected(old('role', $user->role) === 'auditee')>Auditee</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Password Baru</label>
                        <input name="password" type="password" minlength="8"
                               autocomplete="new-password"
                               class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500"
                               placeholder="Kosongkan jika tidak ingin mengubah password">
                        <p class="mt-1 text-xs text-slate-500">
                            Password lama tetap digunakan jika kolom ini dikosongkan.
                        </p>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                        <a href="{{ route('users.index') }}"
                           class="rounded-xl border border-slate-200 px-5 py-3 text-center text-sm font-semibold text-slate-600 hover:bg-slate-50">
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

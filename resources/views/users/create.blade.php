
<x-app-layout>
    <div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6">
        <div class="mx-auto max-w-3xl">
            <a href="{{ route('users.index') }}"
               class="text-sm font-medium text-emerald-700 hover:text-emerald-800">
                ← Kembali ke Users
            </a>

            <div class="mt-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <h1 class="text-2xl font-bold text-slate-800">Tambah User</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Buat akun baru untuk pengguna dashboard SMKP.
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

                <form action="{{ route('users.store') }}" method="POST" class="mt-6 space-y-5">
                    @csrf

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Nama Lengkap</label>
                        <input name="name" value="{{ old('name') }}" required
                               class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500"
                               placeholder="Masukkan nama lengkap">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Nomor Pegawai</label>
                        <input name="employee_number" value="{{ old('employee_number') }}"
                               type="text" inputmode="numeric" pattern="[0-9]{5}"
                               maxlength="5" minlength="5" required
                               class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500"
                               placeholder="Contoh: 00002">
                        <p class="mt-1 text-xs text-slate-500">Harus terdiri dari 5 digit angka.</p>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Email</label>
                        <input name="email" type="email" value="{{ old('email') }}" required
                               class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500"
                               placeholder="nama@perusahaan.com">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Role</label>
                        <select name="role" required
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                            <option value="">Pilih role</option>
                            <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                            <option value="auditor" @selected(old('role') === 'auditor')>Auditor</option>
                            <option value="auditee" @selected(old('role') === 'auditee')>Auditee</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
                        <input name="password" type="password" minlength="8" required
                               autocomplete="new-password"
                               class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500"
                               placeholder="Minimal 8 karakter">
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                        <a href="{{ route('users.index') }}"
                           class="rounded-xl border border-slate-200 px-5 py-3 text-center text-sm font-semibold text-slate-600 hover:bg-slate-50">
                            Batal
                        </a>
                        <button type="submit"
                                class="rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white hover:bg-emerald-700">
                            Simpan User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

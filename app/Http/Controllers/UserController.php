<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Pastikan semua aksi hanya bisa dilakukan admin.
     */
    private function ensureAdmin(): void
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'admin',
            403,
            'Halaman ini hanya bisa diakses oleh admin.'
        );
    }

    public function index()
    {
        $this->ensureAdmin();

        $users = User::orderBy('name')->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $this->ensureAdmin();

        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'employee_number' => [
                'required',
                'digits:5',
                'unique:users,employee_number',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'role' => [
                'required',
                Rule::in(['admin', 'auditor', 'auditee']),
            ],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $this->ensureAdmin();

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'employee_number' => [
                'required',
                'digits:5',
                Rule::unique('users', 'employee_number')
                    ->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'role' => [
                'required',
                Rule::in(['admin', 'auditor', 'auditee']),
            ],
            'password' => ['nullable', 'string', 'min:8'],
        ]);


        // Jangan sampai admin terakhir kehilangan role admin.
        if (
            $user->role === 'admin' &&
            $validated['role'] !== 'admin' &&
            User::where('role', 'admin')->count() <= 1
        ) {
            return back()
                ->withInput($request->except('password'))
                ->with('error', 'Role admin terakhir tidak boleh diubah.');
        }

        // Admin tidak boleh mengubah role akunnya sendiri.
        if (
            $user->id === auth()->id() &&
            $validated['role'] !== 'admin'
        ) {
            return back()
                ->withInput($request->except('password'))
                ->with('error', 'Kamu tidak bisa mengubah role akun sendiri.');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $this->ensureAdmin();

        if ($user->id === auth()->id()) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Kamu tidak bisa menghapus akun sendiri.');
        }

        if (
            $user->role === 'admin' &&
            User::where('role', 'admin')->count() <= 1
        ) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Admin terakhir tidak bisa dihapus.');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}

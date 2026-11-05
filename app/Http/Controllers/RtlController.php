<?php

namespace App\Http\Controllers;

use App\Models\Finding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RtlController extends Controller
{
    /**
     * Mengambil temuan sesuai hak akses user yang login.
     */
    private function findAccessibleFinding(int $id): Finding
    {
        $user = auth()->user();

        $query = Finding::query();

        if ($user->role === 'admin') {
            // Admin dapat mengakses semua temuan.
        } elseif ($user->role === 'auditor') {
            $query->whereHas('audit', function ($auditQuery) use ($user) {
                $auditQuery->where('auditor_id', $user->id);
            });
        } elseif ($user->role === 'auditee') {
            $query->where('auditee_user_id', $user->id);
        } else {
            abort(403, 'Kamu tidak memiliki akses ke temuan ini.');
        }

        return $query->findOrFail($id);
    }

    /**
     * Daftar temuan.
     */
    public function index()
    {
        $user = auth()->user();

        $query = Finding::with('audit');

        if ($user->role === 'admin') {
            $findings = $query->latest()->get();
        } elseif ($user->role === 'auditor') {
            $findings = $query
                ->whereHas('audit', function ($auditQuery) use ($user) {
                    $auditQuery->where('auditor_id', $user->id);
                })
                ->latest()
                ->get();
        } elseif ($user->role === 'auditee') {
            $findings = $query
                ->where('auditee_user_id', $user->id)
                ->latest()
                ->get();
        } else {
            $findings = collect();
        }

        return view('findings.rtl.index', compact('findings'));
    }

    /**
     * Form untuk mengisi RTL.
     */
    public function edit(int $finding)
    {
        $finding = $this->findAccessibleFinding($finding);

        if (! in_array($finding->status, [
            'open',
            'in_progress',
            'revision_required',
            'pending_verification',
        ], true)) {
            abort(403, 'RTL tidak dapat diubah pada tahap sekarang.');
        }

        return view('findings.rtl.edit', compact('finding'));
    }

    /**
     * Simpan RTL dan kirim ke auditor untuk diverifikasi.
     */

    public function update(Request $request, int $finding)
    {
        $finding = $this->findAccessibleFinding($finding);

        // Hanya status ini yang boleh diedit dan dikirim ulang.
        if (! in_array($finding->status, [
            'open',
            'in_progress',
            'revision_required',
            'pending_verification',
        ], true)) {
            abort(403, 'RTL tidak dapat diubah pada tahap sekarang.');
        }

        $validated = $request->validate([
            'rtl_response' => ['required', 'string'],
            'root_cause' => ['required', 'string'],
            'function_name' => ['required', 'string', 'max:150'],
            'auditee' => ['required', 'string', 'max:150'],
            'action_days' => ['required', 'integer', 'min:1'],
            'remove_rtl_files' => ['nullable', 'array'],
            'remove_rtl_files.*' => ['required', 'string', 'max:1000'],

            'rtl_files' => ['nullable', 'array', 'max:10'],
            'rtl_files.*' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,webp,pdf',
                'max:5120',
            ],

            'rtl_file_captions' => ['nullable', 'array', 'max:10'],
            'rtl_file_captions.*' => [
                'required',
                'string',
                'max:1000',
            ],
        ]);

        // Ambil file dan keterangan yang dikirim dari form.
        $uploadedFiles = $request->file('rtl_files', []);
        $newCaptions = $request->input('rtl_file_captions', []);

        $uploadedFiles = is_array($uploadedFiles) ? $uploadedFiles : [];
        $newCaptions = is_array($newCaptions) ? $newCaptions : [];

        // Setiap file baru harus mempunyai keterangan.
        foreach ($uploadedFiles as $index => $file) {
            $caption = trim((string) ($newCaptions[$index] ?? ''));

            if ($caption === '') {
                return back()
                    ->withErrors([
                        "rtl_file_captions.{$index}" =>
                        'Keterangan wajib diisi untuk setiap file bukti.',
                    ])
                    ->withInput();
            }
        }

        // Ambil bukti dan keterangan lama.
        $files = $finding->rtl_files ?? [];
        $captions = $finding->rtl_file_captions ?? [];

        if (is_string($files)) {
            $files = json_decode($files, true) ?? [];
        }

        if (is_string($captions)) {
            $captions = json_decode($captions, true) ?? [];
        }

        $files = is_array($files) ? $files : [];
        $captions = is_array($captions) ? $captions : [];

        // Daftar file lama yang diminta untuk dihapus.
        $removeFiles = $request->input('remove_rtl_files', []);
        $removeFiles = is_array($removeFiles) ? $removeFiles : [];
        $removeFiles = array_values(array_unique($removeFiles));

        // Hanya izinkan penghapusan file yang memang milik temuan ini.
        $finalFiles = [];
        $finalCaptions = [];
        $deletedFiles = [];

        foreach ($files as $index => $path) {
            if (in_array($path, $removeFiles, true)) {
                $deletedFiles[] = $path;
                continue;
            }

            $finalFiles[] = $path;
            $finalCaptions[] = $captions[$index] ?? '';
        }

        // Tolak permintaan penghapusan untuk file yang tidak tercatat.
        foreach ($removeFiles as $removePath) {
            if (! in_array($removePath, $files, true)) {
                return back()
                    ->withErrors([
                        'rtl_files' => 'Permintaan penghapusan bukti tidak valid.',
                    ])
                    ->withInput();
            }
        }

        // Total bukti yang dipertahankan dan file baru maksimal 10.
        if (count($finalFiles) + count($uploadedFiles) > 10) {
            return back()
                ->withErrors([
                    'rtl_files' => 'Total bukti lama dan baru maksimal 10 file.',
                ])
                ->withInput();
        }

        // Pastikan setiap file baru memiliki satu keterangan.
        if (count($uploadedFiles) !== count($newCaptions)) {
            return back()
                ->withErrors([
                    'rtl_file_captions' =>
                    'Setiap file bukti baru wajib memiliki keterangan.',
                ])
                ->withInput();
        }

        // Simpan daftar file yang akan dihapus untuk diproses setelah validasi.
        $filesToDelete = $deletedFiles;

        // Tambahkan bukti baru beserta keterangannya.
        foreach ($uploadedFiles as $index => $file) {
            $path = $file->store('findings/rtl', 'public');

            if ($path === false) {
                return back()
                    ->withErrors([
                        'rtl_files' => 'File bukti gagal disimpan. Silakan coba lagi.',
                    ])
                    ->withInput();
            }

            $finalFiles[] = $path;
            $finalCaptions[] = trim((string) $newCaptions[$index]);
        }

        // Wajib ada minimal satu bukti, baik lama maupun baru.
        if (count($finalFiles) === 0) {
            return back()
                ->withErrors([
                    'rtl_files' => 'Unggah minimal satu bukti perbaikan.',
                ])
                ->withInput();
        }

        // Simpan perubahan RTL dan ajukan kembali untuk verifikasi.
        $finding->rtl_response = $validated['rtl_response'];
        $finding->root_cause = $validated['root_cause'];
        $finding->function_name = $validated['function_name'];
        $finding->auditee = $validated['auditee'];
        $finding->action_days = $validated['action_days'];

        $finding->rtl_files = $finalFiles;
        $finding->rtl_file_captions = $finalCaptions;
        $finding->status = 'pending_verification';

        $finding->save();

        // Hapus file fisik yang sudah tidak dipakai.
        foreach ($filesToDelete as $path) {
            Storage::disk('public')->delete($path);
        }

        return redirect()
            ->route('rtl.index')
            ->with('success', 'RTL berhasil disimpan dan dikirim untuk verifikasi auditor.');
    }
}

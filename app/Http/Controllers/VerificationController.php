<?php

namespace App\Http\Controllers;

use App\Models\Finding;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Memastikan temuan berasal dari audit milik auditor login.
     */
    private function findOwnedFinding(int $id): Finding
    {
        return Finding::with('audit')
            ->whereHas('audit', function ($query) {
                $query->where('auditor_id', auth()->id());
            })
            ->findOrFail($id);
    }

    /**
     * Daftar RTL yang menunggu verifikasi.
     */
    public function index()
    {
        $findings = Finding::with('audit')
            ->whereHas('audit', function ($query) {
                $query->where('auditor_id', auth()->id());
            })
            ->where('status', 'pending_verification')
            ->latest()
            ->get();

        return view('verification.index', compact('findings'));
    }

    /**
     * Detail temuan untuk diperiksa auditor.
     */
    public function show(int $finding)
    {
        $finding = $this->findOwnedFinding($finding);

        if ($finding->status !== 'pending_verification') {
            return redirect()
                ->route('verification.index')
                ->with('error', 'Temuan ini tidak sedang menunggu verifikasi.');
        }

        return view('verification.show', compact('finding'));
    }

    /**
     * Menyetujui hasil perbaikan.
     */
    public function approve(Request $request, int $finding)
    {
        $finding = $this->findOwnedFinding($finding);

        if ($finding->status !== 'pending_verification') {
            return back()->with('error', 'Status temuan sudah berubah.');
        }

        $validated = $request->validate([
            'verified_detail' => ['required', 'string', 'max:5000'],
        ]);

        $finding->verified_detail = $validated['verified_detail'];
        $finding->verified_date = now()->toDateString();
        $finding->status = 'completed';
        $finding->save();

        return redirect()
            ->route('verification.index')
            ->with('success', 'Perbaikan disetujui dan temuan ditandai selesai.');
    }

    /**
     * Meminta auditee melakukan revisi.
     */
    public function requestRevision(Request $request, int $finding)
    {
        $finding = $this->findOwnedFinding($finding);

        if ($finding->status !== 'pending_verification') {
            return back()->with('error', 'Status temuan sudah berubah.');
        }

        $validated = $request->validate([
            'verified_detail' => ['required', 'string', 'max:5000'],
        ]);

        $finding->verified_detail = $validated['verified_detail'];
        $finding->verified_date = now()->toDateString();
        $finding->status = 'revision_required';
        $finding->save();

        return redirect()
            ->route('verification.index')
            ->with('success', 'Temuan dikembalikan kepada auditee untuk direvisi.');
    }
}

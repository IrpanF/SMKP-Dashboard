<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\SmkpAudit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuditController extends Controller
{
    public function index()
    {
        $audits = SmkpAudit::where('auditor_id', auth()->id())
            ->with(['site'])
            ->withCount([
                'assessments',
                'assessments as scored_assessments_count' => function ($query) {
                    $query->where(function ($q) {
                        $q->whereNotNull('score')
                            ->orWhere('is_na', true);
                    });
                },
            ])
            ->orderByDesc('created_at')
            ->get();

        return view('audit.index', compact('audits'));
    }

    public function create()
    {
        $sites = Site::where('is_active', true)
            ->orderBy('site_name')
            ->get();

        return view('audit.create', compact('sites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'site_id' => [
                'required',
                'integer',
                Rule::exists('sites', 'id')->where('is_active', true),
            ],
            'audit_start_date' => ['required', 'date'],
            'audit_end_date' => [
                'required',
                'date',
                'after_or_equal:audit_start_date',
            ],
        ], [
            'title.required' => 'Judul audit wajib diisi.',
            'title.max' => 'Judul audit maksimal 255 karakter.',
            'site_id.required' => 'Site wajib dipilih.',
            'site_id.exists' => 'Site yang dipilih tidak valid atau tidak aktif.',
            'audit_start_date.required' => 'Tanggal mulai audit wajib diisi.',
            'audit_start_date.date' => 'Tanggal mulai audit tidak valid.',
            'audit_end_date.required' => 'Tanggal selesai audit wajib diisi.',
            'audit_end_date.date' => 'Tanggal selesai audit tidak valid.',
            'audit_end_date.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai audit.',
        ]);

        SmkpAudit::create([
            'title' => $validated['title'],
            'site_id' => $validated['site_id'],
            'audit_start_date' => $validated['audit_start_date'],
            'audit_end_date' => $validated['audit_end_date'],
            'audit_date' => $validated['audit_start_date'],
            'auditor_id' => auth()->id(),
            'status' => 'draft',
        ]);

        return redirect()
            ->route('audit.index')
            ->with('success', 'Audit berhasil dibuat.');
    }

    public function edit(SmkpAudit $audit)
    {
        abort_unless(
            (int) $audit->auditor_id === (int) auth()->id(),
            403
        );

        $sites = Site::where(function ($query) use ($audit) {
            $query->where('is_active', true);

            // Tetap tampilkan Site yang sedang dipakai audit
            // meskipun Site tersebut sudah dinonaktifkan.
            if ($audit->site_id) {
                $query->orWhere('id', $audit->site_id);
            }
        })
            ->orderBy('site_name')
            ->get();

        return view('audit.edit', compact('audit', 'sites'));
    }

    public function update(Request $request, SmkpAudit $audit)
    {
        abort_unless(
            (int) $audit->auditor_id === (int) auth()->id(),
            403
        );

        if ($audit->status === 'completed') {
            return redirect()
                ->route('audit.index')
                ->withErrors([
                    'audit' => 'Audit yang sudah selesai tidak dapat diedit.',
                ]);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'audit_start_date' => ['required', 'date'],
            'audit_end_date' => [
                'required',
                'date',
                'after_or_equal:audit_start_date',
            ],
            'site_id' => [
                'sometimes',
                'required',
                'integer',
                Rule::exists('sites', 'id')->where('is_active', true),
            ],
        ], [
            'title.required' => 'Judul audit wajib diisi.',
            'title.max' => 'Judul audit maksimal 255 karakter.',
            'audit_start_date.required' => 'Tanggal mulai audit wajib diisi.',
            'audit_start_date.date' => 'Tanggal mulai audit tidak valid.',
            'audit_end_date.required' => 'Tanggal selesai audit wajib diisi.',
            'audit_end_date.date' => 'Tanggal selesai audit tidak valid.',
            'audit_end_date.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai audit.',
            'site_id.required' => 'Site wajib dipilih.',
            'site_id.exists' => 'Site yang dipilih tidak valid atau tidak aktif.',
        ]);

        $validated['audit_date'] = $validated['audit_start_date'];

        $audit->update($validated);

        return redirect()
            ->route('audit.index')
            ->with('success', 'Data audit berhasil diperbarui.');
    }

    public function destroy(SmkpAudit $audit)
    {
        abort_unless(
            (int) $audit->auditor_id === (int) auth()->id(),
            403
        );

        if ($audit->status === 'completed') {
            return redirect()
                ->route('audit.index')
                ->withErrors([
                    'audit' => 'Audit yang sudah selesai tidak dapat dihapus.',
                ]);
        }

        $audit->delete();

        return redirect()
            ->route('audit.index')
            ->with('success', 'Audit berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Finding;
use App\Models\SmkpAudit;
use App\Models\SmkpElement;
use App\Models\Site;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

use PhpOffice\PhpWord\Shared\Html;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class FindingController extends Controller
{

    public function index(Request $request)
    {
        $query = Finding::with('audit')
            ->whereHas('audit', function ($auditQuery) {
                $auditQuery->where('auditor_id', auth()->id());
            });

        // Filter berdasarkan Site.
        $selectedSite = $request->input('site');

        if ($selectedSite) {
            $request->validate([
                'site' => ['required', 'string', 'exists:sites,site_name'],
            ]);

            $query->where('location_name', $selectedSite);
        }

        // Filter kategori OFI dari database.
        $selectedCategory = $request->input('category');

        if ($selectedCategory) {
            $request->validate([
                'category' => ['required', 'in:ofi'],
            ]);

            $query->whereRaw('LOWER(finding_category) = ?', ['ofi']);
        }

        // Jumlah data per halaman.
        $perPage = (int) $request->input('per_page', 5);

        if (!in_array($perPage, [5, 10, 15, 20, 25], true)) {
            $perPage = 5;
        }

        // Pagination.
        $findings = $query->latest()
            ->paginate($perPage)
            ->withQueryString();

        // Daftar Site.
        $sites = \App\Models\Site::orderBy('site_name')->get();

        return view('findings.index', compact(
            'findings',
            'sites',
            'selectedSite',
            'selectedCategory',
            'perPage'
        ));
    }

    /**
     * Menampilkan form tambah temuan.
     */

    public function create()
    {
        $audits = SmkpAudit::with('site')
            ->where('auditor_id', auth()->id())
            ->whereIn('status', ['draft', 'completed'])
            ->orderByDesc('audit_date')
            ->get();

        // Ambil semua Site dari tabel sites.
        $sites = Site::orderBy('site_name')->get();

        $elements = SmkpElement::with([
            'criteria.children.children.children.children.children',
        ])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('findings.create', compact(
            'audits',
            'elements',
            'sites'
        ));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            // Identitas dan klasifikasi
            'smkp_audit_id' => [
                'required',
                'integer',
                'exists:smkp_audits,id',
            ],
            'finding_criteria' => [
                'required',
                'in:A,B,C,D',
            ],
            'finding_category' => [
                'required',
                'in:mayor,minor,critical,ofi',
            ],
            'form_no' => ['required', 'string', 'max:100'],
            'audit_date' => ['required', 'date'],
            'revision' => ['nullable', 'string', 'max:20'],

            // finding_no tidak perlu divalidasi karena otomatis
            'page' => ['nullable', 'integer', 'min:1'],
            'location_name' => ['required', 'string', 'max:150'],
            'standard' => ['required', 'string', 'max:150'],

            // PLOR
            'problem' => ['required', 'string'],
            'area_temuan' => ['required', 'string'],
            'description' => ['required', 'string'],
            'matriks' => ['required', 'string'],

            // Bukti temuan
            'form_files' => ['nullable', 'array', 'max:10'],
            'form_files.*' => [
                'file',
                'mimes:jpg,jpeg,png,webp,pdf',
                'max:5120',
            ],
            'evidence_captions' => ['nullable', 'array', 'max:10'],
            'evidence_captions.*' => [
                'nullable',
                'string',
                'max:1000',
            ],

            // Rencana Tindak Lanjut
            'rtl_response' => ['nullable', 'string'],
            'rtl_files' => ['nullable', 'array', 'max:10'],
            'rtl_files.*' => [
                'file',
                'mimes:jpg,jpeg,png,webp,pdf',
                'max:5120',
            ],
            'auditee' => ['nullable', 'string', 'max:150'],
            'action_days' => ['nullable', 'integer', 'min:0'],

            // Verifikasi
            'verified_detail' => ['nullable', 'string'],
            'verified_date' => ['nullable', 'date'],
        ], [
            'smkp_audit_id.required' => 'Audit SMKP wajib dipilih.',
            'finding_criteria.required' => 'Kriteria temuan wajib dipilih.',
            'finding_category.in' => 'Kategori temuan tidak valid.',
            'form_no.required' => 'Nomor form wajib diisi.',
            'audit_date.required' => 'Tanggal audit wajib diisi.',
            'location_name.required' => 'Lokasi wajib diisi.',
            'standard.required' => 'Standar atau acuan audit wajib diisi.',
            'description.required' => 'Deskripsi temuan wajib diisi.',
            'form_files.max' => 'Maksimal 10 file bukti temuan.',
            'rtl_files.max' => 'Maksimal 10 file bukti perbaikan.',
            'form_files.*.max' => 'Ukuran setiap bukti temuan maksimal 5 MB.',
            'rtl_files.*.max' => 'Ukuran setiap bukti perbaikan maksimal 5 MB.',
        ]);

        // Pastikan audit milik pengguna yang login.
        $audit = SmkpAudit::where('auditor_id', auth()->id())
            ->findOrFail($validated['smkp_audit_id']);

        // Tentukan kode kategori dan site.
        // Dilakukan sebelum upload agar site tidak valid langsung ditolak.
        $categoryCode = $this->getCategoryCode(
            $validated['finding_category']
        );

        $siteCode = $this->getSiteCode(
            $validated['location_name']
        );

        // Normalisasi nomor revisi: 0 menjadi 00.
        $validated['revision'] = str_pad(
            (string) ($validated['revision'] ?? '0'),
            2,
            '0',
            STR_PAD_LEFT
        );

        // Simpan bukti temuan PLOR.
        $uploadedEvidence = $request->file('form_files', []);
        $evidenceCaptionsInput = $request->input(
            'evidence_captions',
            []
        );

        $evidenceFiles = [];
        $evidenceCaptions = [];

        foreach ($evidenceCaptionsInput as $index => $caption) {
            $caption = trim((string) $caption);
            $file = $uploadedEvidence[$index] ?? null;

            // Abaikan baris yang benar-benar kosong.
            if ($caption === '' && !$file) {
                continue;
            }

            // Simpan file jika tersedia.
            $evidenceFiles[] = $file
                ? $file->store('findings/evidence', 'public')
                : null;

            $evidenceCaptions[] = $caption;
        }

        $validated['evidence_files'] = $evidenceFiles;
        $validated['evidence_captions'] = $evidenceCaptions;

        // Simpan bukti RTL.
        $validated['rtl_files'] = collect(
            $request->file('rtl_files', [])
        )->map(function ($file) {
            return $file->store('findings/rtl', 'public');
        })->values()->all();

        // Field upload bukan kolom langsung pada tabel findings.
        unset($validated['form_files']);

        // Buat nomor temuan dan simpan dalam satu transaksi.
        $finding = DB::transaction(function () use (
            $validated,
            $categoryCode,
            $siteCode,
            $audit
        ) {
            // Ambil sequence dan kunci barisnya.
            $sequence = DB::table('finding_number_sequences')
                ->where('category_code', $categoryCode)
                ->where('site_code', $siteCode)
                ->lockForUpdate()
                ->first();

            if (!$sequence) {
                throw ValidationException::withMessages([
                    'location_name' => 'Nomor urut untuk kategori dan site ini belum tersedia.',
                ]);
            }

            // Tambah nomor urut.
            $nextNumber = $sequence->last_number + 1;

            DB::table('finding_number_sequences')
                ->where('id', $sequence->id)
                ->update([
                    'last_number' => $nextNumber,
                    'updated_at' => now(),
                ]);

            // Bentuk nomor otomatis.
            $validated['finding_no'] = sprintf(
                '%s-%s-%03d',
                $categoryCode,
                $siteCode,
                $nextNumber
            );

            // Simpan temuan melalui relasi audit.
            return $audit->findings()->create($validated);
        });

        return redirect()
            ->route('findings.index')
            ->with(
                'success',
                'Temuan audit berhasil disimpan dengan nomor ' .
                    $finding->finding_no
            );
    }

    /**
     * Memastikan temuan milik audit pengguna yang login.
     */
    private function findOwnedFinding(int $id): Finding
    {
        return Finding::whereHas('audit', function ($query) {
            $query->where('auditor_id', auth()->id());
        })->findOrFail($id);
    }

    /**
     * Menampilkan detail temuan audit.
     */
    public function show(int $finding)
    {
        $finding = $this->findOwnedFinding($finding);

        return view('findings.show', compact('finding'));
    }

    public function edit(Finding $finding)
    {
        $audits = SmkpAudit::with('site')
            ->where('auditor_id', auth()->id())
            ->whereIn('status', ['draft', 'completed'])
            ->orderByDesc('audit_date')
            ->get();

        $sites = Site::orderBy('site_name')->get();

        $elements = SmkpElement::with([
            'criteria.children.children.children.children.children',
        ])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('findings.edit', compact(
            'finding',
            'audits',
            'sites',
            'elements'
        ));
    }

    public function update(Request $request, int $finding)
    {
        $finding = $this->findOwnedFinding($finding);

        $validated = $request->validate([
            'smkp_audit_id' => ['required', 'integer', 'exists:smkp_audits,id'],
            'finding_criteria' => ['required', 'in:A,B,C,D'],
            'finding_category' => ['required', 'in:mayor,minor,OFI'],
            'form_no' => ['required', 'string', 'max:100'],
            'audit_date' => ['required', 'date'],
            'revision' => ['nullable', 'string', 'max:20'],
            'finding_no' => ['required', 'string', 'max:100'],
            'page' => ['nullable', 'integer', 'min:1'],
            'location_name' => ['required', 'string', 'max:150'],
            'standard' => ['required', 'string', 'max:150'],

            'problem' => ['required', 'string'],
            'area_temuan' => ['required', 'string'],
            'description' => ['required', 'string'],
            'matriks' => ['required', 'string'],

            'form_files' => ['nullable', 'array', 'max:10'],
            'form_files.*' => ['file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:5120'],
            'evidence_captions' => ['nullable', 'array', 'max:10'],
            'evidence_captions.*' => ['required', 'string', 'max:1000'],
            'evidence_captions_existing' => ['nullable', 'array'],
            'evidence_captions_existing.*' => ['nullable', 'string', 'max:1000'],

            'rtl_response' => ['nullable', 'string'],
            'rtl_files' => ['nullable', 'array', 'max:10'],
            'rtl_files.*' => ['file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:5120'],
            'rtl_file_captions' => ['nullable', 'array', 'max:10'],
            'rtl_file_captions.*' => ['required', 'string', 'max:1000'],
            'rtl_file_captions_existing' => ['nullable', 'array'],
            'rtl_file_captions_existing.*' => ['nullable', 'string', 'max:1000'],

            'auditee' => ['nullable', 'string', 'max:150'],
            'action_days' => ['nullable', 'integer', 'min:0'],
            'verified_detail' => ['nullable', 'string'],
            'verified_date' => ['nullable', 'date'],

            'remove_evidence_indices' => ['nullable', 'array'],
            'remove_evidence_indices.*' => ['required', 'integer', 'min:0'],
            'remove_rtl_indices' => ['nullable', 'array'],
            'remove_rtl_indices.*' => ['required', 'integer', 'min:0'],
        ]);

        // Pastikan audit tujuan milik auditor yang login.
        SmkpAudit::where('auditor_id', auth()->id())
            ->findOrFail($validated['smkp_audit_id']);

        $validated['revision'] = str_pad(
            (string) ($validated['revision'] ?? '0'),
            2,
            '0',
            STR_PAD_LEFT
        );

        // File lama dan keterangannya.
        $evidenceFiles = $finding->evidence_files ?? [];
        $evidenceCaptions = $finding->evidence_captions ?? [];
        $rtlFiles = $finding->rtl_files ?? [];
        $rtlCaptions = $finding->rtl_file_captions ?? [];

        $evidenceFiles = is_array($evidenceFiles) ? $evidenceFiles : [];
        $evidenceCaptions = is_array($evidenceCaptions) ? $evidenceCaptions : [];
        $rtlFiles = is_array($rtlFiles) ? $rtlFiles : [];
        $rtlCaptions = is_array($rtlCaptions) ? $rtlCaptions : [];

        $newEvidence = $request->file('form_files', []);
        $newEvidenceCaptions = $request->input('evidence_captions', []);
        $newRtlFiles = $request->file('rtl_files', []);
        $newRtlCaptions = $request->input('rtl_file_captions', []);

        if (count($newEvidence) !== count($newEvidenceCaptions)) {
            return back()->withErrors([
                'evidence_captions' => 'Setiap bukti temuan baru wajib memiliki keterangan.',
            ])->withInput();
        }

        if (count($newRtlFiles) !== count($newRtlCaptions)) {
            return back()->withErrors([
                'rtl_file_captions' => 'Setiap bukti perbaikan baru wajib memiliki keterangan.',
            ])->withInput();
        }

        $existingEvidenceCaptions = $request->input('evidence_captions_existing', []);
        $existingRtlCaptions = $request->input('rtl_file_captions_existing', []);

        foreach ($evidenceFiles as $index => $file) {
            if (array_key_exists($index, $existingEvidenceCaptions)) {
                $evidenceCaptions[$index] = trim(
                    (string) ($existingEvidenceCaptions[$index] ?? '')
                );
            } else {
                $evidenceCaptions[$index] = $evidenceCaptions[$index] ?? '';
            }
        }

        foreach ($rtlFiles as $index => $file) {
            if (array_key_exists($index, $existingRtlCaptions)) {
                $rtlCaptions[$index] = trim(
                    (string) ($existingRtlCaptions[$index] ?? '')
                );
            } else {
                $rtlCaptions[$index] = $rtlCaptions[$index] ?? '';
            }
        }

        // Indeks file yang ditandai melalui tombol X.
        $removeEvidence = array_unique(array_map(
            'intval',
            $request->input('remove_evidence_indices', [])
        ));

        $removeRtl = array_unique(array_map(
            'intval',
            $request->input('remove_rtl_indices', [])
        ));

        // Pastikan indeks yang dikirim memang ada.
        foreach ($removeEvidence as $index) {
            if (!array_key_exists($index, $evidenceFiles)) {
                return back()->withErrors([
                    'form_files' => 'Indeks bukti temuan tidak valid.',
                ])->withInput();
            }
        }

        foreach ($removeRtl as $index) {
            if (!array_key_exists($index, $rtlFiles)) {
                return back()->withErrors([
                    'rtl_files' => 'Indeks bukti perbaikan tidak valid.',
                ])->withInput();
            }
        }

        // Catat path file yang dihapus; hapus fisiknya setelah update DB berhasil.
        $deletedPaths = [];

        foreach ($removeEvidence as $index) {
            $deletedPaths[] = $evidenceFiles[$index];
        }

        foreach ($removeRtl as $index) {
            $deletedPaths[] = $rtlFiles[$index];
        }

        // Susun ulang file lama yang dipertahankan beserta keterangannya.
        $keptEvidenceFiles = [];
        $keptEvidenceCaptions = [];

        foreach ($evidenceFiles as $index => $file) {
            if (in_array($index, $removeEvidence, true)) {
                continue;
            }

            $keptEvidenceFiles[] = $file;
            $keptEvidenceCaptions[] = $evidenceCaptions[$index] ?? '';
        }

        $keptRtlFiles = [];
        $keptRtlCaptions = [];

        foreach ($rtlFiles as $index => $file) {
            if (in_array($index, $removeRtl, true)) {
                continue;
            }

            $keptRtlFiles[] = $file;
            $keptRtlCaptions[] = $rtlCaptions[$index] ?? '';
        }

        $evidenceFiles = $keptEvidenceFiles;
        $evidenceCaptions = $keptEvidenceCaptions;
        $rtlFiles = $keptRtlFiles;
        $rtlCaptions = $keptRtlCaptions;

        // Tambahkan file baru beserta keterangannya.
        foreach ($newEvidence as $index => $file) {
            $evidenceFiles[] = $file->store('findings/evidence', 'public');
            $evidenceCaptions[] = trim($newEvidenceCaptions[$index]);
        }

        foreach ($newRtlFiles as $index => $file) {
            $rtlFiles[] = $file->store('findings/rtl', 'public');
            $rtlCaptions[] = trim($newRtlCaptions[$index]);
        }

        $validated['evidence_files'] = array_values($evidenceFiles);
        $validated['evidence_captions'] = array_values($evidenceCaptions);
        $validated['rtl_files'] = array_values($rtlFiles);
        $validated['rtl_file_captions'] = array_values($rtlCaptions);

        unset(
            $validated['form_files'],
            $validated['evidence_captions'],
            $validated['evidence_captions_existing'],
            $validated['rtl_files'],
            $validated['rtl_file_captions'],
            $validated['rtl_file_captions_existing'],
            $validated['remove_evidence_indices'],
            $validated['remove_rtl_indices']
        );

        // Pastikan data file dan caption ikut tersimpan.
        $validated['evidence_files'] = array_values($evidenceFiles);
        $validated['evidence_captions'] = array_values($evidenceCaptions);
        $validated['rtl_files'] = array_values($rtlFiles);
        $validated['rtl_file_captions'] = array_values($rtlCaptions);

        $finding->update($validated);

        // Hapus file fisik setelah update database berhasil.
        foreach ($deletedPaths as $path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($path);
        }

        return redirect()
            ->route('findings.show', $finding->id)
            ->with('success', 'Temuan audit berhasil diperbarui.');
    }

    public function destroy(int $finding)
    {
        $finding = $this->findOwnedFinding($finding);

        // Hapus file bukti temuan
        foreach ($finding->evidence_files ?? [] as $file) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($file);
        }

        // Hapus file tindak lanjut
        foreach ($finding->rtl_files ?? [] as $file) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($file);
        }

        $finding->delete();

        return redirect()
            ->route('findings.index')
            ->with('success', 'Temuan audit berhasil dihapus.');
    }

    /**
     * Export satu temuan menjadi formulir ketidaksesuaian Word.
     * Berlaku untuk temuan yang belum maupun sudah masuk RTL.
     */
    public function preview(int $finding)
    {
        $finding = $this->findOwnedFinding($finding);

        $kategoriAsli = strtolower(
            trim((string) ($finding->finding_category ?? ''))
        );

        $kategori = match ($kategoriAsli) {
            'mayor' => 'Mayor',
            'minor' => 'Minor',
            'kritikal', 'critical', 'critical finding' => 'Kritikal',
            'observasi', 'ofi' => 'Observasi',
            default => ucfirst($kategoriAsli),
        };

        $nomorBagian = array_filter([
            trim((string) ($finding->finding_no ?? '')),
            $kategori,
            trim((string) ($finding->location_name ?? '')),
        ], fn($value) => $value !== '');

        $nomorKetidaksesuaian = implode('-', $nomorBagian);

        $lokasi = implode(' | ', array_filter([
            trim((string) ($finding->location_name ?? '')),
            trim((string) ($finding->area_temuan ?? '')),
            trim((string) ($finding->department_name ?? '')),
        ], fn($value) => $value !== ''));

        return view('findings.preview', compact(
            'finding',
            'kategori',
            'nomorKetidaksesuaian',
            'lokasi'
        ));
    }


    public function exportWord(int $finding)
    {
        $finding = $this->findOwnedFinding($finding);

        /* ------------------------------------------------------------
     * 1. DATA
     * ---------------------------------------------------------- */
        $kategoriAsli = strtolower(trim((string) ($finding->finding_category ?? '')));

        $kategori = match ($kategoriAsli) {
            'mayor' => 'Mayor',
            'minor' => 'Minor',
            'kritikal', 'critical', 'critical finding' => 'Kritikal',
            'ofi' => 'OFI',
            default => ucfirst($kategoriAsli),
        };

        $nomorBagian = array_filter([
            trim((string) ($finding->finding_no ?? '')),
            $kategori,
            trim((string) ($finding->location_name ?? '')),
        ], fn($value) => $value !== '');

        $nomorKetidaksesuaian = implode('-', $nomorBagian);

        // Isi baris "Area / Lokasi dan Departemen" di tabel
        $lokasi = trim((string) ($finding->area_temuan ?? ''));

        // Format tanggal yang aman (Carbon maupun string)
        $fmtTanggal = function ($value) {
            if (empty($value)) {
                return '';
            }
            try {
                return \Illuminate\Support\Carbon::parse($value)->format('d-m-Y');
            } catch (\Throwable $e) {
                return (string) $value;
            }
        };

        // Nama perusahaan ditulis manual, lalu diikuti nama site
        $perusahaan = 'PT United Tractors Semen Gresik';
        $namaSite   = trim((string) ($finding->location_name ?? ''));

        $namaPerusahaan = $namaSite !== ''
            ? $perusahaan . ' - ' . $namaSite
            : $perusahaan;
        $tanggalAudit   = $fmtTanggal($finding->audit_date ?? null);
        $batasWaktu     = $fmtTanggal($finding->due_date ?? null);        // sesuaikan nama kolom

        // Normalisasi data bukti (array / JSON / Collection) -> array
        $keArray = function ($v): array {
            if (is_string($v)) {
                $d = json_decode($v, true);
                return is_array($d) ? $d : (trim($v) !== '' ? [$v] : []);
            }
            if (is_object($v) && method_exists($v, 'toArray')) {
                $v = $v->toArray();
            }
            return is_array($v) ? $v : [];
        };

        // sesuaikan nama kolom/properti dengan yang dipakai di Blade Anda
        $evidenceCaptions = $keArray($finding->evidence_captions ?? []);
        $evidenceFiles    = $keArray($finding->evidence_files ?? []);

        $tempFiles = []; // file sementara (konversi webp) yang dihapus setelah save

        /* ------------------------------------------------------------
     * 2. SETUP DOKUMEN
     * ---------------------------------------------------------- */
        // Escape otomatis karakter & < > agar XML Word tidak rusak
        if (method_exists(\PhpOffice\PhpWord\Settings::class, 'setOutputEscapingEnabled')) {
            \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
        }

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(10);

        $section = $phpWord->addSection([
            'marginTop'    => 1000,
            'marginBottom' => 1000,
            'marginLeft'   => 1000,
            'marginRight'  => 1000,
        ]);

        $W = 9900; // lebar konten (twips)

        $font  = ['name' => 'Arial', 'size' => 10];
        $bold  = $font + ['bold' => true];
        $ital  = $font + ['italic' => true];
        $tight = ['spaceBefore' => 0, 'spaceAfter' => 0];
        $box   = ['borderSize' => 6, 'borderColor' => '808080'];

        /* ------------------------------------------------------------
     * 3. HELPER
     * ---------------------------------------------------------- */

        // Isi cell dengan teks (mendukung baris baru)
        $isiTeks = function ($cell, ?string $text) use ($font, $tight) {
            // Buang karakter kontrol yang tidak valid di XML
            $text = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F]/', '', (string) $text);
            $text = trim($text);
            if ($text === '') {
                $cell->addText('', $font, $tight);
                return;
            }
            foreach (preg_split('/\r\n|\r|\n/', $text) as $baris) {
                $cell->addText($baris, $font, $tight);
            }
        };

        // Jarak kecil antar blok
        $jarak = function (int $size = 8) use ($section) {
            $section->addTextBreak(1, ['size' => $size], ['spaceBefore' => 0, 'spaceAfter' => 0]);
        };

        // Judul bagian (bold)
        $judulBagian = function (string $text) use ($section, $bold) {
            $section->addText($text, $bold, ['spaceBefore' => 0, 'spaceAfter' => 120]);
        };

        // Baris "Label ........ [kotak isian]"
        $barisIsian = function (string $label, ?string $value, int $lw, int $vw) use ($section, $bold, $box, $tight, $isiTeks) {
            $t = $section->addTable(['cellMargin' => 80]);
            $t->addRow(450);
            $t->addCell($lw, ['valign' => 'center'])->addText($label, $bold, $tight);
            $isiTeks($t->addCell($vw, $box + ['valign' => 'center']), $value);
        };

        // Blok judul + kotak isi besar
        $blok = function (string $judul, int $tinggi, ?string $value = '') use ($section, $W, $box, $font, $tight, $isiTeks) {
            $t = $section->addTable(['cellMargin' => 80]);
            $t->addRow(420);
            $t->addCell($W, $box)->addText($judul, $font, $tight);
            $t->addRow($tinggi);
            $isiTeks($t->addCell($W, $box), $value);
        };

        // Tabel tanda tangan: Nama | .. | Tanda Tangan | .. | Tanggal | ..
        $barisTtd = function (array $labelNama) use ($section, $font, $box, $tight) {
            $lebar = [1700, 2000, 1600, 1700, 1100, 1800];
            $t = $section->addTable(['cellMargin' => 80]);
            foreach ($labelNama as $label) {
                $t->addRow(520);
                $t->addCell($lebar[0], $box + ['valign' => 'center'])->addText($label, $font, $tight);
                $t->addCell($lebar[1], $box)->addText('', $font, $tight);
                $t->addCell($lebar[2], $box + ['valign' => 'center'])->addText('Tanda Tangan', $font, $tight);
                $t->addCell($lebar[3], $box)->addText('', $font, $tight);
                $t->addCell($lebar[4], $box + ['valign' => 'center'])->addText('Tanggal', $font, $tight);
                $t->addCell($lebar[5], $box)->addText('', $font, $tight);
            }
        };

        // Isi cell Bukti: keterangan + gambar, atau keterangan saja, atau '-'
        $isiBukti = function ($cell) use (
            $evidenceCaptions,
            $evidenceFiles,
            $font,
            $ital,
            $tight,
            &$tempFiles
        ) {
            $indeks = array_unique(array_merge(
                array_keys($evidenceCaptions),
                array_keys($evidenceFiles)
            ));

            $ada = false;

            foreach ($indeks as $i) {
                $caption = trim((string) ($evidenceCaptions[$i] ?? ''));
                $file    = $evidenceFiles[$i] ?? null;

                if ($caption === '' && empty($file)) {
                    continue;
                }
                $ada = true;

                if ($caption !== '') {
                    $cell->addText($caption, $font, ['spaceBefore' => 60, 'spaceAfter' => 60]);
                }

                if (!empty($file)) {
                    $path = public_path('storage/' . ltrim((string) $file, '/'));
                    $ext  = strtolower(pathinfo((string) $file, PATHINFO_EXTENSION));

                    // PhpWord tidak mendukung webp -> konversi ke png sementara
                    if (
                        $ext === 'webp' && is_file($path)
                        && function_exists('imagecreatefromwebp')
                    ) {
                        $img = @imagecreatefromwebp($path);
                        if ($img) {
                            $tmp = tempnam(sys_get_temp_dir(), 'ev_') . '.png';
                            imagepng($img, $tmp);
                            imagedestroy($img);
                            $tempFiles[] = $tmp;
                            $path = $tmp;
                            $ext  = 'png';
                        }
                    }

                    $info = (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'], true) && is_file($path))
                        ? @getimagesize($path)
                        : false;

                    if ($info) {
                        // Batasi ukuran agar muat di kolom (satuan point)
                        $maxW = 260;
                        $maxH = 280;
                        $skala = min($maxW / $info[0], $maxH / $info[1], 1);

                        $cell->addImage($path, [
                            'width'  => (int) round($info[0] * $skala),
                            'height' => (int) round($info[1] * $skala),
                        ]);
                    } else {
                        $cell->addText('Lampiran: ' . basename((string) $file), $ital, $tight);
                    }
                }

                $cell->addTextBreak(1, ['size' => 4], $tight);
            }

            if (!$ada) {
                $cell->addText('-', $font, $tight);
            }
        };

        // Label dua bahasa: "Uraian Masalah" + "(Problem)"
        $labelDua = function ($cell, string $indo, string $inggris) use ($font, $ital, $tight) {
            $cell->addText($indo, $font, ['spaceBefore' => 0, 'spaceAfter' => 40]);
            $run = $cell->addTextRun($tight);
            $run->addText('(', $font);
            $run->addText($inggris, $ital);
            $run->addText(')', $font);
        };

        /* ------------------------------------------------------------
     * 4. HALAMAN 1 : IDENTITAS & URAIAN KETIDAKSESUAIAN
     * ---------------------------------------------------------- */
        $section->addText(
            'FORMULIR KETIDAKSESUAIAN DAN TINDAK LANJUT KETIDAKSESUAIAN AUDIT',
            ['name' => 'Arial', 'size' => 11, 'bold' => true],
            ['alignment' => 'center', 'spaceAfter' => 60]
        );
        $section->addText(
            'PENERAPAN SISTEM MANAJEMEN KESELAMATAN PERTAMBANGAN',
            ['name' => 'Arial', 'size' => 11, 'bold' => true],
            ['alignment' => 'center', 'spaceAfter' => 300]
        );

        $barisIsian('Nama Perusahaan', $namaPerusahaan, 2800, 7100);
        $jarak();
        $barisIsian('Tanggal Audit', $tanggalAudit, 2800, 7100);
        $jarak();
        $barisIsian('Nomor Ketidaksesuaian', $nomorKetidaksesuaian, 2800, 7100);
        $jarak(12);

        $judulBagian('Uraian Ketidaksesuaian: ');

        // Checkbox kategori
        $kotak = fn(bool $x) => $x ? "\u{2612}" : "\u{2610}"; // ☒ / ☐
        $daftarKategori = ['Kritikal', 'Mayor', 'Minor'];

        $uraian = $section->addTable([
            'borderSize'  => 6,
            'borderColor' => '808080',
            'cellMargin'  => 80,
        ]);

        $barisUraian = [
            'problem' => ['Uraian Masalah', 'Problem', $finding->problem ?? '', 900],
            'lokasi'  => ['Area / Lokasi dan Departemen', 'Location', $lokasi, 900],
            'bukti'   => ['Bukti', 'Objective Evidence', null, 1200],
            'ref'     => ['Referensi / Elemen / Subelemen', 'Reference', $finding->matriks ?? '', 900],
        ];

        $i = 0;
        foreach ($barisUraian as $kunci => [$indo, $inggris, $isi, $tinggi]) {
            // Baris bukti boleh terpotong antar halaman (bisa berisi banyak gambar)
            $uraian->addRow($tinggi, ['cantSplit' => $kunci !== 'bukti']);

            $labelDua($uraian->addCell(2000, ['valign' => 'top']), $indo, $inggris);

            $cIsi = $uraian->addCell(5900, ['valign' => 'top']);
            if ($kunci === 'bukti') {
                $isiBukti($cIsi);
            } else {
                $isiTeks($cIsi, (string) $isi);
            }

            if ($i === 0) {
                // Kolom Kategori (digabung vertikal untuk 4 baris)
                $cKat = $uraian->addCell(2000, ['vMerge' => 'restart', 'valign' => 'top']);
                $cKat->addText('Kategori', $font, ['spaceBefore' => 0, 'spaceAfter' => 40]);

                foreach ($daftarKategori as $k) {
                    $run = $cKat->addTextRun([
                        'spaceBefore' => 0,
                        'spaceAfter'  => 60,
                        'lineHeight'  => 1.0,
                        'alignment'   => 'left',
                    ]);
                    // Kotak & teks memakai font + ukuran yang sama agar sejajar
                    $fKotak = ['name' => 'Segoe UI Symbol', 'size' => 16];
                    $fTeks  = ['name' => 'Arial', 'size' => 11];

                    $run->addText($kotak($k === $kategori), $fKotak);
                    $run->addText(' ' . $k, $fTeks);
                }
            } else {
                $uraian->addCell(2000, ['vMerge' => 'continue']);
            }
            $i++;
        }

        // Baris Deskripsi (lebar penuh)
        $uraian->addRow(1500);
        $cDesk = $uraian->addCell($W, ['gridSpan' => 3, 'valign' => 'top']);
        $cDesk->addText('Deskripsi: ', $font, ['spaceBefore' => 0, 'spaceAfter' => 60]);
        $isiTeks($cDesk, (string) ($finding->description ?? ''));

        $section->addPageBreak(); // Batas Waktu Perbaikan mulai di halaman baru

        $judulBagian('Batas Waktu Perbaikan');
        $t = $section->addTable(['cellMargin' => 80]);
        $t->addRow(450);
        $isiTeks($t->addCell($W, $box + ['valign' => 'center']), $batasWaktu);

        $jarak(12);

        $barisTtd(['Nama Auditor', 'Nama Auditi']);

        /* ------------------------------------------------------------
     * 5. HALAMAN 2 : TINDAK LANJUT & ULASAN AUDITOR
     * ---------------------------------------------------------- */
        $jarak(16);

        $judulBagian('Tindak Lanjut Audit');

        $blok('Investigasi Akar Permasalahan', 1100);
        $jarak();
        $blok('Tindakan Perbaikan', 1500);
        $jarak();
        $blok('Bukti', 1100);
        $jarak();

        $t = $section->addTable(['cellMargin' => 80]);
        $t->addRow(450);
        $t->addCell(2000, $box + ['valign' => 'center'])->addText('Tanggal Perbaikan', $font, $tight);
        $t->addCell($W - 2000, $box)->addText('', $font, $tight);

        $jarak();
        $barisTtd(['Nama Auditi']);

        $jarak(16);

        $judulBagian('Ulasan Tim Auditor');
        $barisIsian('Nomor Tindak Lanjut', '', 2800, 7100);
        $jarak();
        $blok('Verifikasi', 1100);
        $jarak();
        $barisTtd(['Nama Auditor']);

        /* ------------------------------------------------------------
     * 6. SIMPAN, VALIDASI, DOWNLOAD (tidak berubah)
     * ---------------------------------------------------------- */
        $safeNumber = preg_replace(
            '/[^A-Za-z0-9_-]/',
            '_',
            (string) ($finding->finding_no ?: $finding->id)
        );

        $filename = 'Formulir_Ketidaksesuaian_' . $safeNumber . '.docx';

        $folder = storage_path('app/exports');

        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        $filePath = $folder . DIRECTORY_SEPARATOR . $filename;

        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($filePath);

        foreach ($tempFiles as $tmp) {
            @unlink($tmp);
        }

        // Pastikan file Word valid sebelum dikirim.
        $zip = new \ZipArchive();
        $result = $zip->open($filePath);

        if ($result !== true) {
            @unlink($filePath);

            throw new \RuntimeException('File Word tidak valid. Kode ZIP: ' . $result);
        }

        $valid = $zip->locateName('[Content_Types].xml') !== false
            && $zip->locateName('word/document.xml') !== false;

        $zip->close();

        if (!$valid) {
            @unlink($filePath);

            throw new \RuntimeException('Struktur dokumen Word tidak lengkap.');
        }

        return response()->download($filePath, $filename, [
            'Content-Type' =>
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ])->deleteFileAfterSend(true);
    }

    public function exportPdf()
    {
        $findings = Finding::with('audit')
            ->whereHas('audit', function ($query) {
                $query->where('auditor_id', auth()->id());
            })
            ->latest()
            ->get();

        $pdf = Pdf::loadView('findings.report-pdf', [
            'findings' => $findings,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('Laporan_Temuan_Ketidaksesuaian.pdf');
    }

    public function exportSelectedPdf(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'findings' => ['required', 'array', 'min:1'],
            'findings.*' => ['required', 'integer', 'distinct'],
            'site' => ['required', 'string', 'exists:sites,site_name'],
            'audit_date' => ['required', 'date'],
        ], [
            'findings.required' => 'Pilih minimal satu temuan untuk diekspor.',
            'findings.min' => 'Pilih minimal satu temuan untuk diekspor.',
            'site.required' => 'Silakan pilih site terlebih dahulu.',
            'site.exists' => 'Site yang dipilih tidak valid.',
            'audit_date.required' => 'Silakan pilih tanggal laporan.',
            'audit_date.date' => 'Tanggal laporan tidak valid.',
        ]);

        // Ambil temuan yang dicentang, milik auditor yang login,
        // dan sesuai site. Tidak memfilter tanggal temuan.
        $findings = Finding::with('audit')
            ->whereHas('audit', function ($query) {
                $query->where('auditor_id', auth()->id());
            })
            ->whereIn('id', $validated['findings'])
            ->where('location_name', $validated['site'])
            ->orderBy('id')
            ->get();

        // Pastikan semua temuan yang dicentang bisa diakses
        // dan sesuai dengan site pilihan.
        if ($findings->count() !== count($validated['findings'])) {
            return back()->withErrors([
                'findings' => 'Ada temuan yang tidak sesuai dengan site pilihan atau tidak dapat diakses.',
            ]);
        }

        $reportDate = $validated['audit_date'];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'findings.report-pdf',
            [
                'findings' => $findings,
                'selectedSite' => $validated['site'],
                'reportDate' => $reportDate,
                'dateFrom' => $reportDate,
                'dateTo' => $reportDate,
            ]
        )->setPaper('a4', 'landscape');

        return $pdf->download('Laporan_Temuan_Terpilih.pdf');
    }

    public function exportSelectedExternalPdf(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'findings' => ['required', 'array', 'min:1'],
            'findings.*' => ['required', 'integer', 'distinct'],
            'site' => ['required', 'string', 'exists:sites,site_name'],
            'audit_date' => ['required', 'date'],
        ], [
            'findings.required' => 'Pilih minimal satu temuan untuk diekspor.',
            'findings.min' => 'Pilih minimal satu temuan untuk diekspor.',
            'site.required' => 'Silakan pilih site terlebih dahulu.',
            'site.exists' => 'Site yang dipilih tidak valid.',
            'audit_date.required' => 'Silakan pilih tanggal laporan.',
            'audit_date.date' => 'Tanggal laporan tidak valid.',
        ]);

        $findings = \App\Models\Finding::with('audit')
            ->whereHas('audit', function ($query) {
                $query->where('auditor_id', auth()->id());
            })
            ->whereIn('id', $validated['findings'])
            ->where('location_name', $validated['site'])
            ->orderBy('id')
            ->get();

        if ($findings->count() !== count($validated['findings'])) {
            return back()->withErrors([
                'findings' => 'Ada temuan yang tidak sesuai dengan site pilihan atau tidak dapat diakses.',
            ]);
        }

        $reportDate = $validated['audit_date'];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'findings.report-eksternal-pdf',
            [
                'findings' => $findings,
                'selectedSite' => $validated['site'],
                'reportDate' => $reportDate,
            ]
        )->setPaper('a4', 'landscape');

        return $pdf->download('Rekapitulasi_Ketidaksesuaian_Eksternal.pdf');
    }

    public function exportSelectedOfiPdf(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'findings' => ['required', 'array', 'min:1'],
            'findings.*' => ['required', 'integer', 'distinct'],
            'site' => ['required', 'string', 'exists:sites,site_name'],
            'audit_date' => ['required', 'date'],
        ], [
            'findings.required' => 'Pilih minimal satu temuan OFI.',
            'findings.min' => 'Pilih minimal satu temuan OFI.',
            'site.required' => 'Silakan pilih site terlebih dahulu.',
            'site.exists' => 'Site yang dipilih tidak valid.',
            'audit_date.required' => 'Silakan pilih tanggal audit.',
            'audit_date.date' => 'Tanggal audit tidak valid.',
        ]);

        $findings = Finding::with('audit')
            ->whereHas('audit', function ($query) {
                $query->where('auditor_id', auth()->id());
            })
            ->whereIn('id', $validated['findings'])
            ->where('location_name', $validated['site'])
            ->where('finding_category', 'ofi')
            ->orderBy('id')
            ->get();

        // Pastikan semua ID yang dipilih adalah OFI yang dapat diakses
        // dan sesuai dengan site pilihan.
        if ($findings->count() !== count($validated['findings'])) {
            return back()->withErrors([
                'findings' => 'Pastikan semua temuan yang dipilih berkategori OFI, sesuai site, dan dapat diakses.',
            ]);
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'findings.report-ofi-pdf',
            [
                'findings' => $findings,
                'selectedSite' => $validated['site'],
                'reportDate' => $validated['audit_date'],
            ]
        )->setPaper('a4', 'landscape');

        return $pdf->download('Formulir_Rekomendasi_Peluang_Perbaikan_OFI.pdf');
    }

    /**
     * Menentukan kode site berdasarkan nama site.
     */
    private function getSiteCode(string $siteName): string
    {
        $site = strtolower(trim(
            preg_replace('/\s+/', ' ', $siteName)
        ));

        return match ($site) {
            'pt semen indonesia tuban' => 'SITBN',
            'pt semen indonesia rembang' => 'SIRBG',
            'pt solusi bangun indonesia tuban' => 'SBITBN',
            'pt semen tonasa' => 'ST',
            'pt semen padang' => 'SP',
            'pt omi sale' => 'OMI',

            default => throw \Illuminate\Validation\ValidationException::withMessages([
                'location_name' => 'Site tidak dikenali: ' . $siteName,
            ]),
        };
    }

    /**
     * Menentukan kode kategori temuan.
     */
    private function getCategoryCode(string $category): string
    {
        return match (strtolower(trim($category))) {
            'minor' => 'MNR',
            'mayor' => 'MYR',
            'critical', 'kritikal' => 'CRITICAL',
            'ofi' => 'OFI',

            default => throw \Illuminate\Validation\ValidationException::withMessages([
                'finding_category' => 'Kategori temuan tidak valid.',
            ]),
        };
    }
}

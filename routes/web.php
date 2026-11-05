<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditChecklistController;
use App\Http\Controllers\MasterDataSmkpController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\FindingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RtlController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;

// Halaman utama: arahkan ke login jika belum masuk, atau dashboard jika sudah login.
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Master Data SMKP
Route::get('/master-data/smkp', [MasterDataSmkpController::class, 'index'])
    ->middleware('auth')
    ->name('master-data.smkp');

// Audit Checklist
Route::middleware('auth')->group(function () {

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create');
    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy');

    Route::get('/audit/checklist', [AuditChecklistController::class, 'index'])
        ->name('audit.checklist');
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Manajemen Audit SMKP
    Route::get('/audits', [\App\Http\Controllers\AuditController::class, 'index'])
        ->name('audit.index');
    Route::get('/audits/create', [\App\Http\Controllers\AuditController::class, 'create'])
        ->name('audit.create');
    Route::post('/audits', [\App\Http\Controllers\AuditController::class, 'store'])
        ->name('audit.store');

    Route::post('/audits/{audit}/save', [\App\Http\Controllers\AuditChecklistController::class, 'save'])
        ->name('audit.save');
    Route::post('/audits/{audit}/complete', [\App\Http\Controllers\AuditChecklistController::class, 'complete'])
        ->name('audit.complete');
    Route::get('/audits/{audit}/result', [\App\Http\Controllers\AuditChecklistController::class, 'result'])
        ->name('audit.result');

    Route::get('/audits/{audit}/edit', [\App\Http\Controllers\AuditController::class, 'edit'])
        ->name('audit.edit');
    Route::put('/audits/{audit}', [\App\Http\Controllers\AuditController::class, 'update'])
        ->name('audit.update');
    Route::delete('/audits/{audit}', [\App\Http\Controllers\AuditController::class, 'destroy'])
        ->name('audit.destroy');

    Route::post('/audits/{audit}/revise', [
        \App\Http\Controllers\AuditChecklistController::class,
        'revise'
    ])->name('audit.revise');

    // Manajemen Temuan Audit SMKP
    Route::get('/findings', [
        \App\Http\Controllers\FindingController::class,
        'index'
    ])->name('findings.index');
    Route::get('/findings/create', [
        \App\Http\Controllers\FindingController::class,
        'create'
    ])->name('findings.create');
    Route::post('/findings', [
        \App\Http\Controllers\FindingController::class,
        'store'
    ])->name('findings.store');

    // EXPORT PDF HARUS SEBELUM /findings/{finding}
    Route::get('/findings/export-pdf', [
        FindingController::class,
        'exportPdf'
    ])->name('findings.export-pdf');

    Route::post('/findings/export-pdf-selected', [
        FindingController::class,
        'exportSelectedPdf'
    ])->name('findings.export-pdf-selected');

    Route::post(
        '/findings/export-eksternal-pdf-selected',
        [FindingController::class, 'exportSelectedExternalPdf']
    )->name('findings.export-external-pdf-selected');

    Route::post('/findings/export-ofi-pdf-selected', [
        FindingController::class,
        'exportSelectedOfiPdf'
    ])->name('findings.export-ofi-pdf-selected');

    // Detail, edit, update, dan hapus temuan
    Route::get('/findings/{finding}', [FindingController::class, 'show'])
        ->name('findings.show');
    Route::get('/findings/{finding}/edit', [FindingController::class, 'edit'])
        ->name('findings.edit');
    Route::put('/findings/{finding}', [FindingController::class, 'update'])
        ->name('findings.update');
    Route::delete('/findings/{finding}', [FindingController::class, 'destroy'])
        ->name('findings.destroy');

    // Halaman khusus auditee
    Route::middleware('role:auditor,auditee')->prefix('rtl')->name('rtl.')->group(function () {
        Route::get('/', [RtlController::class, 'index'])
            ->name('index');
        Route::get('/{finding}/edit', [RtlController::class, 'edit'])
            ->name('edit');
        Route::put('/{finding}', [RtlController::class, 'update'])
            ->name('update');
    });

    // Verifikasi Temuan oleh Auditor
    Route::middleware('role:auditor')->prefix('verification')->name('verification.')->group(function () {
        Route::get('/', [VerificationController::class, 'index'])
            ->name('index');
        Route::get('/{finding}', [VerificationController::class, 'show'])
            ->name('show');
        Route::post('/{finding}/approve', [VerificationController::class, 'approve'])
            ->name('approve');
        Route::post('/{finding}/revision', [VerificationController::class, 'requestRevision'])
            ->name('revision');
    });

    Route::middleware('role:auditor')
        ->get('/peta-site', [SiteMapController::class, 'index'])
        ->name('sites.map');

    Route::get('/findings/{finding}/preview', [
        FindingController::class,
        'preview'
    ])->name('findings.preview');
    // Export satu temuan ke dokumen Word
    Route::get('/findings/{finding}/export-word', [
        FindingController::class,
        'exportWord'
    ])->name('findings.export-word');

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::get('/laporan/{audit}/kesesuaian-pdf', [
        LaporanController::class,
        'cetakKesesuaianPdf'
    ])->name('laporan.kesesuaian-pdf');
});

require __DIR__ . '/auth.php';

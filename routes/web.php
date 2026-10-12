<?php

use App\Http\Controllers\ProfileController;
use App\Models\SmkpElement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditChecklistController;

// Halaman utama: arahkan ke login jika belum masuk,
// atau dashboard jika sudah login.
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard hanya bisa diakses setelah login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Master Data SMKP
Route::get('/master-data/smkp', function () {
    $elements = SmkpElement::with([
        'criteria' => function ($query) {
            $query->whereNull('parent_id')
                ->where('is_active', true)
                ->orderBy('sort_order');
        },
        'criteria.indicators',
        'criteria.children.indicators',
        'criteria.children.children.indicators',
        'criteria.children.children.children.indicators',
    ])
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    return view('master-data.smkp', compact('elements'));
})->middleware(['auth'])->name('master-data.smkp');

// Audit Checklist
Route::middleware('auth')->group(function () {
    Route::get('/audit/checklist', [
        AuditChecklistController::class,
        'index'
    ])->name('audit.checklist');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';
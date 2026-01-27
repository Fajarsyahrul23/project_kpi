<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BpdController;
use App\Http\Controllers\KpiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware(['department.auth'])->group(function () {
    // BPD Routes
    Route::get('/bpd/export-pdf', [BpdController::class, 'exportPdf'])->name('bpd.export.pdf');
    Route::resource('bpd', BpdController::class);

    // KPI Routes
    Route::get('/bpd/{id_bpd}/kpi', [KpiController::class, 'index'])->name('kpi.index');
    Route::post('/kpi/store', [KpiController::class, 'store'])->name('kpi.store');
    Route::put('/kpi/{id_kpi}', [KpiController::class, 'update'])->name('kpi.update');
    Route::delete('/kpi/{id_kpi}', [KpiController::class, 'destroy'])->name('kpi.destroy');

    // KPI Import
    Route::get('/bpd/{id_bpd}/kpi/import', [KpiController::class, 'importView'])->name('kpi.import.view');
    Route::post('/kpi/import', [KpiController::class, 'import'])->name('kpi.import.store');
    Route::get('/kpi/template', [KpiController::class, 'downloadTemplate'])->name('kpi.template');
});

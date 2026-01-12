<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Livewire\Surat\Index;
use App\Livewire\Surat\CreateSurat;
use App\Livewire\Surat\EditSurat;
use App\Livewire\Surat\ShowSurat;
use App\Models\SuratModel;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    return view('welcome');
});

//AUTH
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//DASBOARD
Route::middleware('auth')->group(function () {

    Route::get('/pejabat/dashboard', function () {
        return view('dashboard.pejabat');
    })->name('pejabat.dashboard')->middleware('pejabat');

    Route::get('/pegawai/dashboard', function () {
        return view('dashboard.pegawai');
    })->name('pegawai.dashboard');
});

//SURAT PEGAWAI
Route::middleware(['auth', 'role:pegawai'])->group(function () {
    Route::get('/surat', Index::class)->name('surat.riwayat');
    Route::get('/surat/create', CreateSurat::class)->name('surat.pengajuan');
    Route::get('/surat/{surat}/edit', EditSurat::class)->name('surat.edit');
    Route::get('/surat/{surat}', ShowSurat::class)->name('surat.show');
    Route::get('/surat/{surat}/pdf-preview', function (SuratModel $surat) {
        return Pdf::loadView('pdf.surat', compact('surat'))
            ->stream();
    })->name('surat.pdf.preview');
});

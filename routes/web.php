<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\DonasiPublicController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\PenanamanController;
use App\Http\Controllers\PerawatanApiController;
use App\Http\Controllers\PerawatanController;
use App\Http\Controllers\PengadaanBibitController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PemanenanController;
use App\Http\Controllers\BibitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManajemenAkunController;
use App\Http\Controllers\ProfileController;

// ═══════════════════════════════════════════════
//  Halaman depan
// ═══════════════════════════════════════════════
Route::view('/', 'halaman_depan.index');

// ═══════════════════════════════════════════════
//  Auth
// ═══════════════════════════════════════════════
Route::get('/sesi',  [AuthController::class, 'index'])->name('login');
Route::post('/sesi', [AuthController::class, 'login'])->name('auth.login');

// ═══════════════════════════════════════════════
//  Public Donasi Routes (tanpa auth)
//  static routes (success/pending/error)
// ═══════════════════════════════════════════════
Route::prefix('donasi')->name('donasi.public.')->group(function () {
    Route::get('/',        [DonasiPublicController::class, 'index'])->name('index');
    Route::get('/create',  [DonasiPublicController::class, 'create'])->name('create');

    //  POST store, return JSON snap_token
    Route::post('/store',  [DonasiPublicController::class, 'store'])->name('store');

    //  Static routes
    Route::get('/success', [DonasiPublicController::class, 'success'])->name('success');
    Route::get('/pending', [DonasiPublicController::class, 'pending'])->name('pending');
    Route::get('/error',   [DonasiPublicController::class, 'error'])->name('error');

    // Midtrans webhook — CSRF 
    Route::post('/notification', [DonasiPublicController::class, 'notification'])->name('notification');

    //Callback
    Route::get('/callback', [DonasiPublicController::class, 'callback'])->name('callback');


    // Route dengan parameter {donasi}
    Route::get('/{donasi}',         [DonasiPublicController::class, 'show'])->name('show');
    Route::get('/{donasi}/payment', [DonasiPublicController::class, 'payment'])->name('payment');
});

// Public API stats
Route::get('/api/donasi/stats', [DonasiPublicController::class, 'getStats'])->name('donasi.public.stats');
Route::get('/api/donasi/donors', [DonasiPublicController::class, 'getDonors'])->name('donasi.public.donors');
Route::get('/api/donasi/status/{orderId}', [DonasiPublicController::class, 'checkStatus'])->name('donasi.public.check.status');

// ═══════════════════════════════════════════════
//  Cetak Laporan 
// ═══════════════════════════════════════════════
Route::get('/penanaman/cetak',      [PenanamanController::class,      'cetak'])->name('penanaman.cetak');
Route::get('/pengadaan_bibit/cetak',[PengadaanBibitController::class, 'cetak'])->name('pengadaan_bibit.cetak');
Route::get('/pemanenan/cetak',      [PemanenanController::class,      'cetak'])->name('pemanenan.cetak');
Route::get('/perawatan/cetak',      [PerawatanController::class,      'cetak'])->name('perawatan.cetak');
Route::get('/penjualan/cetak',      [PenjualanController::class,      'cetak'])->name('penjualan.cetak');

// ═══════════════════════════════════════════════
//  API Perawatan
// ═══════════════════════════════════════════════
Route::prefix('api')->group(function () {
    Route::get   ('perawatan',           [PerawatanApiController::class, 'index']);
    Route::post  ('perawatan',           [PerawatanApiController::class, 'store']);
    Route::get   ('perawatan/{perawatan}',[PerawatanApiController::class, 'show']);
    Route::put   ('perawatan/{perawatan}',[PerawatanApiController::class, 'update']);
    Route::delete('perawatan/{perawatan}',[PerawatanApiController::class, 'destroy']);
});

// ═══════════════════════════════════════════════
//  Auth — Admin + User
// ═══════════════════════════════════════════════
Route::middleware(['auth', 'check_role:admin,user'])->group(function () {
    Route::resource('penanaman', PenanamanController::class);
    Route::resource('perawatan', PerawatanController::class);
    Route::resource('pemanenan', PemanenanController::class);
    Route::get('/profile',  [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// ═══════════════════════════════════════════════
//  Auth — User 
// ═══════════════════════════════════════════════
Route::middleware(['auth', 'check_role:user'])->group(function () {
    Route::get('/poinakses/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

// ═══════════════════════════════════════════════
//  Auth — Admin 
// ═══════════════════════════════════════════════
Route::middleware(['auth', 'check_role:admin'])->group(function () {
    Route::get('/poinakses/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/api/admin/stats',           [AdminController::class, 'getStats'])->name('admin.stats');

    Route::post('/clear-notifications', function () {
        session()->forget('notifications');
        return response()->json(['status' => 'cleared']);
    })->name('clear-notifications');

    Route::resource('penjualan',        PenjualanController::class);
    Route::resource('pengadaan_bibit',  PengadaanBibitController::class);
    Route::resource('bibit',            BibitController::class);
    Route::resource('manajemen_akun',   ManajemenAkunController::class);

    // Admin Donasi Management
    Route::prefix('admin/donasi')->name('admin.donasi.')->group(function () {
        Route::get('/',              [DonasiController::class, 'index'])->name('index');
        Route::get('/create',        [DonasiController::class, 'create'])->name('create');
        Route::post('/',             [DonasiController::class, 'store'])->name('store');
        Route::get('/cetak',         [DonasiController::class, 'cetak'])->name('cetak');
        Route::get('/{donasi}',      [DonasiController::class, 'show'])->name('show');
        Route::delete('/{donasi}',   [DonasiController::class, 'destroy'])->name('destroy');
        Route::get('/{donasi}/payment', [DonasiController::class, 'payment'])->name('payment');
        Route::get('/{donasi}/success', [DonasiController::class, 'success'])->name('success');
        Route::get('/{donasi}/pending', [DonasiController::class, 'pending'])->name('pending');
        Route::get('/{donasi}/error',   [DonasiController::class, 'error'])->name('error');
    });
    Route::get('/api/admin/donasi/stats', [DonasiController::class, 'getStats'])->name('admin.donasi.stats');

    // Midtrans Callback (admin) - TODO: Implement if needed
    // Route::post('/donasi/callback', [DonasiController::class, 'callback'])->name('donasi.callback');

    // Penggajian
    Route::resource('penggajian', PenggajianController::class);
    Route::get('/penggajian/cetak', [PenggajianController::class, 'cetak'])->name('penggajian.cetak');
});

// ═══════════════════════════════════════════════
//  Logout
// ═══════════════════════════════════════════════
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

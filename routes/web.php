<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PeminjamanController;
use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\Peminjaman;

// 1. Halaman Awal Langsung Lempar ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. KELOMPOK AKSES YANG WAJIB LOGIN (`auth`)
Route::middleware(['auth'])->group(function () {

    // Dashboard untuk bersama (Isinya sudah otomatis nge-filter berdasarkan role)
    Route::get('/dashboard', function () {
        $totalPengguna = Peminjam::count();
        $totalPeralatan = Barang::sum('stok');
        $peminjamanAktif = Peminjaman::where('status_peminjaman', 'Dipinjam')->count();
        $stokMenipis = Barang::where('stok', '<=', 3)->get();

        return view('dashboard', compact('totalPengguna', 'totalPeralatan', 'peminjamanAktif', 'stokMenipis'));
    })->name('dashboard');

    // Modul Barang & Peminjaman: GLOBAL (Admin BISA, User juga BISA CRUD Penuh)
    Route::resource('barang', BarangController::class);
    Route::resource('peminjaman', PeminjamanController::class);

    // [BARU DI SINI] Rute Ekspor Laporan Excel & PDF (Bisa diakses Admin & User)
    Route::get('/export-peminjaman-excel', [PeminjamanController::class, 'exportExcel'])->name('peminjaman.excel');
    Route::get('/export-peminjaman-pdf', [PeminjamanController::class, 'exportPdf'])->name('peminjaman.pdf');

    // KELOMPOK AKSES: HANYA BOLEH DIAKSES OLEH ADMIN (User Kena 403 Jamin!)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('peminjam', PeminjamController::class); // CRUD Peminjam Siswa
    });

    // Rute Profile Bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. Panggil Sistem Autentikasi Breeze
require __DIR__.'/auth.php';

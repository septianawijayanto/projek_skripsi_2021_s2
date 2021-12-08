<?php

use App\Http\Controllers\Backend\Admin\AnggotaController;
use App\Http\Controllers\Backend\Admin\BukuController;
use App\Http\Controllers\Backend\Admin\DashboardController;
use App\Http\Controllers\Backend\Admin\DendaController;
use App\Http\Controllers\Backend\Admin\EBookController;
use App\Http\Controllers\Backend\Admin\KlasifikasiController;
use App\Http\Controllers\Backend\Admin\LaporanController;
use App\Http\Controllers\Backend\Admin\PenerbitController;
use App\Http\Controllers\Backend\Admin\PengembalianController;
use App\Http\Controllers\Backend\Admin\SekolahController;
use App\Http\Controllers\Backend\Admin\TransaksiController;
use App\Http\Controllers\Backend\Anggota\BukuController as AnggotaBukuController;
use App\Http\Controllers\Backend\Anggota\DashboardController as AnggotaDashboardController;
use App\Http\Controllers\Backend\Anggota\MelihatTransaksiController;
use App\Http\Controllers\Backend\Anggota\PeminjamanController;
use App\Http\Controllers\Backend\Auth\LoginController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});
Route::get('login', [LoginController::class, 'index']);
Route::post('post/login', [LoginController::class, 'postlogin']);
Route::get('logout', [LoginController::class, 'logout']);
Route::get('post/login/cek-username/json', [LoginController::class, 'cek_username']);
Route::get('post/login/cek-password/json', [LoginController::class, 'cek_password']);

Route::group(['middleware' => 'admin'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //Anggota
        Route::get('anggota', [AnggotaController::class, 'index'])->name('anggota');
        Route::get('anggota/{id}/edit', [AnggotaController::class, 'edit']);
        Route::post('anggota', [AnggotaController::class, 'store'])->name('anggota.store');
        Route::delete('anggota/{id}', [AnggotaController::class, 'delete']);
        Route::get('anggota/print', [AnggotaController::class, 'print'])->name('anggota.print');

        //Buku
        Route::get('buku', [BukuController::class, 'index'])->name('buku');
        Route::post('buku', [BukuController::class, 'store'])->name('buku.store');
        Route::get('buku/{id}/edit', [BukuController::class, 'edit']);
        Route::delete('buku/{id}', [BukuController::class, 'delete']);
        Route::get('buku/{id}/show', [BukuController::class, 'show'])->name('buku.show');
        Route::get('buku/print', [BukuController::class, 'print'])->name('buku.print');

        //E-Book
        Route::get('e-book', [EBookController::class, 'index'])->name('e-book');
        Route::get('e-book/ajax', [EBookController::class, 'ajax'])->name('e-book.ajax');
        Route::post('e-book/store', [EBookController::class, 'store'])->name('e-book.store');
        Route::get('e-book/{id}/edit', [EBookController::class, 'edit']);
        Route::delete('e-book/{id}', [EBookController::class, 'delete']);
        Route::get('e-book/{id}/show', [EBookController::class, 'show'])->name('e-book.show');

        //Penerbit
        Route::get('penerbit', [PenerbitController::class, 'index'])->name('penerbit');
        Route::get('penerbit/ajax', [PenerbitController::class, 'ajax'])->name('penerbit.ajax');
        Route::post('penerbit', [PenerbitController::class, 'store'])->name('penerbit.store');
        Route::get('penerbit/{id}/edit', [PenerbitController::class, 'edit']);
        Route::delete('penerbit/{id}', [PenerbitController::class, 'delete']);

        //klasifikasi
        Route::get('klasifikasi', [KlasifikasiController::class, 'index'])->name('klasifikasi');
        Route::post('klasifikasi', [KlasifikasiController::class, 'store'])->name('klasifikasi.store');
        Route::get('klasifikasi/{id}/edit', [KlasifikasiController::class, 'edit']);
        Route::delete('klasifikasi/{id}', [KlasifikasiController::class, 'delete']);

        //Transaksi Peminjaman
        Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi');
        Route::get('transaksi/ajax', [TransaksiController::class, 'ajax'])->name('transaksi.ajax');
        Route::post('transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
        Route::get('nama_buku/{id}', [TransaksiController::class, 'nama_buku']);
        Route::get('nama_anggota/{id}', [TransaksiController::class, 'nama_anggota']);
        Route::get('transaksi/{id}/perpanjang', [TransaksiController::class, 'perpanjang']);


        //Transaksi Pengembalian
        Route::get('pengembalian', [PengembalianController::class, 'index'])->name('pengembalian');
        Route::get('pengembalian/ajax', [PengembalianController::class, 'ajax'])->name('pengembalian.ajax');
        Route::get('pengembalian/{id}/kembali', [PengembalianController::class, 'kembali']);
        Route::get('pengembalian/{id}/rusak', [PengembalianController::class, 'rusak']);
        Route::get('pengembalian/{id}/hilang', [PengembalianController::class, 'hilang']);


        //Denda
        Route::get('denda', [DendaController::class, 'index'])->name('denda');
        Route::get('denda/{id}/lunasi', [DendaController::class, 'lunasi']);
        Route::get('denda/{id}/cetak', [DendaController::class, 'cetak']);

        // Sekolah
        Route::get('sekolah', [SekolahController::class, 'index'])->name('sekolah');
        Route::post('sekolah', [SekolahController::class, 'store'])->name('sekolah.store');
        Route::get('sekolah/edit', [SekolahController::class, 'edit']);
        //Laporan
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::get('laporan/all', [LaporanController::class, 'laporan'])->name('laporan.all');
        Route::get('laporan/print', [LaporanController::class, 'print'])->name('laporan.print');
    });
});



Route::group(['middleware' => 'anggota'], function () {
    Route::prefix('anggota')->group(function () {
        Route::get('dashboard', [AnggotaDashboardController::class, 'index'])->name('dashboard.index');

        Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('peminjaman/ajax', [PeminjamanController::class, 'ajax'])->name('peminjaman.ajax');
        Route::post('peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::get('judul-buku/{id}', [PeminjamanController::class, 'judulbuku']);

        Route::get('t-denda', [MelihatTransaksiController::class, 'tdenda'])->name('transaksi.denda');
        Route::get('buku', [AnggotaBukuController::class, 'bindex'])->name('buku.index');
        Route::get('ebook', [AnggotaBukuController::class, 'eindex'])->name('e-book.index');
        Route::get('ebook/{id}/show', [AnggotaBukuController::class, 'show']);
    });
});

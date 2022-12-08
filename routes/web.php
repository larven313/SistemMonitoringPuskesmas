<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AntriController;
use App\Http\Controllers\JadwalDokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\PemasukanObatController;
use App\Http\Controllers\SuplaiController;
use App\Http\Controllers\PuskesmasController;
use App\Http\Controllers\PuskesmasItemController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Models\pemasukanObat;
use Illuminate\Routing\Router;

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

Route::get('/', [AntriController::class, 'welcome'])->name('welcome');
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/antrian/create', [AntrianController::class, 'create'])->name('antrian.create'); // ganti jadi AntrianController
Route::post('/antrian/store', [AntrianController::class, 'store'])->name('antrian.store');

// Harus login dulu, baru bisa menggunakan jalur
Route::group(['middleware' => 'auth'], function () {

    Route::get('/index', function () {
        return view('welcome');
    })->name("index");

    Route::get('/index/print{id}', function () {
        return view('print');
    })->name("print");

    // ->middleware('admin')


    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/update{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/destroy{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/categories/show{id}', [CategoryController::class, 'show'])->name('categories.show');
    // Route::post('/tes_cari', [CategoryController::class, 'cari'])->name('categories.cari');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/update{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/destroy{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/show{id}', [UserController::class, 'show'])->name('users.show');

    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai');
    Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('/pegawai/edit{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::post('/pegawai/update{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::get('/pegawai/destroy{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
    Route::get('/pegawai/show{id}', [PegawaiController::class, 'show'])->name('pegawai.show');

    Route::get('/antrian', [AntrianController::class, 'index'])->name('antrian');
    Route::get('/antrian/edit{id}', [AntrianController::class, 'edit'])->name('antrian.edit');
    Route::post('/antrian/update{id}', [AntrianController::class, 'update'])->name('antrian.update');
    Route::get('/antrian//destroy{id}', [AntrianController::class, 'destroy'])->name('antrian.destroy');
    Route::get('/antrian/daftar-antrian', [AntrianController::class, 'daftar_antrian'])->name('antrian.show');

    Route::get('/obat', [ObatController::class, 'index'])->name('obat');
    Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create');
    Route::post('/obat/store', [ObatController::class, 'store'])->name('obat.store');
    Route::get('/obat/edit{id}', [ObatController::class, 'edit'])->name('obat.edit');
    Route::post('/obat/update{id}', [ObatController::class, 'update'])->name('obat.update');
    Route::get('/obat/destroy{id}', [ObatController::class, 'destroy'])->name('obat.destroy');
    Route::get('/obat/resep-obat{id}', [ObatController::class, 'show'])->name('obat.show');

    Route::get('/suplai', [SuplaiController::class, 'index'])->name('suplai');
    Route::get('/suplai/create', [SuplaiController::class, 'create'])->name('suplai.create');
    Route::post('/suplai/store', [SuplaiController::class, 'store'])->name('suplai.store');
    Route::get('/suplai/edit{id}', [SuplaiController::class, 'edit'])->name('suplai.edit');
    Route::post('/suplai/update{id}', [SuplaiController::class, 'update'])->name('suplai.update');
    Route::get('/suplai/destroy{id}', [SuplaiController::class, 'destroy'])->name('suplai.destroy');
    Route::get('/suplai/daftar-suplai{id}', [SuplaiController::class, 'show'])->name('suplai.show');

    Route::get('/pemasukan-obat', [PemasukanObatController::class, 'index'])->name('pemasukan-obat');
    Route::get('/pemasukan-obat/create', [PemasukanObatController::class, 'create'])->name('pemasukan-obat.create');
    Route::post('/pemasukan-obat/store', [PemasukanObatController::class, 'store'])->name('pemasukan-obat.store');
    Route::get('/pemasukan-obat/edit{id}', [PemasukanObatController::class, 'edit'])->name('pemasukan-obat.edit');
    Route::post('/pemasukan-obat/update{id}', [PemasukanObatController::class, 'update'])->name('pemasukan-obat.update');
    Route::get('/pemasukan-obat/destroy{id}', [PemasukanObatController::class, 'destroy'])->name('pemasukan-obat.destroy');
    Route::get('/pemasukan-obat/daftar-suplai{id}', [PemasukanObatController::class, 'show'])->name('pemasukan-obat.show');

    Route::get('/puskesmas', [PuskesmasController::class, 'index'])->name('puskesmas');
    Route::get('/puskesmas/create', [PuskesmasController::class, 'create'])->name('puskesmas.create');
    Route::post('/puskesmas/store', [PuskesmasController::class, 'store'])->name('puskesmas.store');
    Route::get('/puskesmas/edit{id}', [PuskesmasController::class, 'edit'])->name('puskesmas.edit');
    Route::post('/puskesmas/update{id}', [PuskesmasController::class, 'update'])->name('puskesmas.update');
    Route::get('/puskesmas/destroy{id}', [PuskesmasController::class, 'destroy'])->name('puskesmas.destroy');
    Route::get('/puskesmas/daftar-puskesmas{id}', [PuskesmasController::class, 'show'])->name('puskesmas.show');

    Route::get('/puskesmas/daftar-puskesmas/delete{id}', [PuskesmasItemController::class, 'destroy'])->name('puskesmas.delete');
    Route::get('/puskesmas/tambah', [PuskesmasItemController::class, 'create'])->name('puskesmas.tambah');
    Route::post('/puskesmas/proses', [PuskesmasItemController::class, 'store'])->name('puskesmas.proses');

    Route::get('/poli', [PoliController::class, 'index'])->name('poli');
    Route::get('/poli/create', [PoliController::class, 'create'])->name('poli.create');
    Route::post('/poli/store', [PoliController::class, 'store'])->name('poli.store');
    Route::get('/poli/edit{id}', [PoliController::class, 'edit'])->name('poli.edit');
    Route::post('/poli/update{id}', [PoliController::class, 'update'])->name('poli.update');
    Route::get('/poli/destroy{id}', [PoliController::class, 'destroy'])->name('poli.destroy');
    Route::get('/poli/daftar-poli{id}', [PoliController::class, 'show'])->name('poli.show');

    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter');
    Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create');
    Route::post('/dokter/store', [DokterController::class, 'store'])->name('dokter.store');
    Route::get('/dokter/edit{id}', [DokterController::class, 'edit'])->name('dokter.edit');
    Route::post('/dokter/update{id}', [DokterController::class, 'update'])->name('dokter.update');
    Route::get('/dokter/destroy{id}', [DokterController::class, 'destroy'])->name('dokter.destroy');
    Route::get('/dokter/daftar-dokter{id}', [DokterController::class, 'show'])->name('dokter.show');

    Route::get('/jadwal-dokter', [JadwalDokterController::class, 'index'])->name('jadwal-dokter');
    Route::get('/jadwal-dokter/create', [JadwalDokterController::class, 'create'])->name('jadwal-dokter.create');
    Route::post('/jadwal-dokter/store', [JadwalDokterController::class, 'store'])->name('jadwal-dokter.store');
    Route::get('/jadwal-dokter/edit{id}', [JadwalDokterController::class, 'edit'])->name('jadwal-dokter.edit');
    Route::post('/jadwal-dokter/update{id}', [JadwalDokterController::class, 'update'])->name('jadwal-dokter.update');
    Route::get('/jadwal-dokter/destroy{id}', [JadwalDokterController::class, 'destroy'])->name('jadwal-dokter.destroy');
    Route::get('/jadwal-dokter/daftar-jadwal-dokter{id}', [JadwalDokterController::class, 'show'])->name('jadwal-dokter.show');


    // Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Auth::routes();

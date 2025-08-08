<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TahunPelajaranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\smsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PinjamanController;


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

// Route::get('/login', function() {
// 	return view('login');
// });

// Auth::routes();

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/login/admin', [LoginController::class, 'form_admin'])->name('login_admin');
Route::post('/postlogin', [LoginController::class, 'postlogin']);
Route::post('/postlogin_siswa', [LoginController::class, 'postlogin_siswa']);
Route::post('/postloginAdmin', [LoginController::class, 'postloginAdmin']);




Route::group(['middleware' => ['auth', 'cekLevel:admin']], function(){	
	Route::get('/beranda', [HomeController::class, 'index']);
	
	Route::get('/siswa', [SiswaController::class, 'index']);
	Route::get('/siswa/{id_kelas}', [SiswaController::class, 'indexByKelas']);
	Route::get('/siswa/tambah', [SiswaController::class, 'create']);
	Route::post('/siswa/tambah', [SiswaController::class, 'store']);
	Route::get('/siswa/edit/{id_siswa}', [SiswaController::class, 'edit']);
	Route::get('/siswa/hapus/{id_siswa}', [SiswaController::class, 'destroy']);
	Route::post('/siswa/edit/', [SiswaController::class, 'update']);

	Route::get('/admin', [AdminController::class, 'index']);
	Route::get('/admin/tambah', [AdminController::class, 'create']);
	Route::post('/admin/tambah', [AdminController::class, 'store']);
	Route::get('/admin/edit/{id_admin}', [AdminController::class, 'edit']);
	Route::post('/admin/edit/', [AdminController::class, 'update']);
	Route::get('/admin/hapus/{id_admin}', [AdminController::class, 'destroy']);

	Route::get('/orang_tua', [OrangTuaController::class, 'index']);
	
	Route::get('/orang_tua/edit/{id_orangtua}', [OrangTuaController::class, 'edit']);
	Route::post('/orang_tua/edit/', [OrangTuaController::class, 'update']);
	


	Route::get('/tapel', [TahunPelajaranController::class, 'index']);
	Route::get('/tapel/tambah', [TahunPelajaranController::class, 'create']);
	Route::post('/tapel/tambah', [TahunPelajaranController::class, 'store']);
	Route::get('/tapel/edit/{id_tapel}', [TahunPelajaranController::class, 'edit']);
	Route::post('/tapel/edit', [TahunPelajaranController::class, 'update']);
	Route::get('/tapel/hapus/{id_tapel}', [TahunPelajaranController::class, 'destroy']);

	Route::get('/kelas', [KelasController::class, 'index']);
	Route::post('/kelas/tambah', [KelasController::class, 'store']);
	Route::get('/kelas/hapus/{id_kelas}', [KelasController::class, 'destroy']);
	Route::post('/kelas/edit', [KelasController::class, 'update']);

	Route::get('/tabungan/{id_kelas}', [TabunganController::class, 'index']);
	Route::get('/tabungan/tambah/{id_kelas}', [TabunganController::class, 'create']);
	Route::post('/tabungan/tambah', [TabunganController::class, 'store']);
	Route::get('/tabungan/total_tabungan/{id_kelas}', [TabunganController::class, 'total_tabungan']);
	Route::post('/tabungan/exportExcel', [TabunganController::class, 'exportExcel']);
	Route::post('/tabungan/exportPDF', [TabunganController::class, 'exportPDF']);
	Route::get('/logout/admin', [LoginController::class, 'logout_admin']);

	Route::get('/user/edit_admin/{id_user}/{level}', [UserController::class, 'edit_admin']);
	Route::post('/user/edit_admin', [UserController::class, 'update_admin']);

	Route::get('/notifikasi/sudah-terbaca', [NotifikasiController::class, 'sudah_terbaca']);

	
	Route::get('/sms', [smsController::class, 'index']);
	Route::get('/sendSms/{id_orangtua}', [smsController::class, 'sendSms']);

});



Route::group(['middleware' => ['auth', 'cekLevel:siswa']], function(){
	Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard']);
	Route::get('/siswa/tabungan/rincian', [SiswaController::class, 'rincian_tabungan']);
	Route::get('/siswa/tabungan/total', [SiswaController::class, 'total_tabungan']);
	Route::get('/siswa/pembayaran', [SiswaController::class, 'input_bayar']);
	Route::post('/siswa/proses_bayar', [SiswaController::class, 'proses_bayar']);
	Route::get('/user/edit_siswa/{id_user}/{level}', [UserController::class, 'edit_siswa']);
	Route::post('/user/edit_siswa', [UserController::class, 'update_siswa']);
	Route::get('/notifikasi/sudah-terbaca/{id_notifikasi}', [NotifikasiController::class, 'sudah_terbaca_siswa']);
	Route::get('/siswa/pinjaman', [PinjamanController::class, 'data_pinjaman']);
	Route::post('/siswa/proses_pinjam', [PinjamanController::class, 'proses_pinjam']);
	Route::get('/siswa/cicilan', [PinjamanController::class, 'data_cicilan']);
	Route::post('/siswa/proses_cicilan', [PinjamanController::class, 'proses_cicilan']);
    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::group(['middleware' => ['auth', 'cekLevel:orang tua']], function(){
	Route::get('/orang_tua/dashboard', [OrangTuaController::class, 'dashboard']);
	Route::get('/orang_tua/tabungan/total', [OrangTuaController::class, 'total_tabungan']);
	Route::get('/orang_tua/tabungan/rincian', [OrangTuaController::class, 'rincian_tabungan']);
	Route::get('/user/edit/{id_user}/{level}', [UserController::class, 'edit']);
	Route::post('/user/edit', [UserController::class, 'update']);
	Route::get('/notifikasi/sudah-terbaca-orang_tua/{id_notifikasi}', [NotifikasiController::class, 'sudah_terbaca_orangtua']);
    Route::get('/logout', [LoginController::class, 'logout']);
});


Route::group(['middleware' => ['auth', 'cekLevel:siswa,orang tua']], function(){
	
	
});

Route::get('/',[HomeController::class, 'login']);











// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LabaBulananController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PembayaranUserController;
use App\Http\Controllers\PenjualanBulananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PesananUserController;
use App\Http\Controllers\PrediksiLabaController;
use App\Http\Controllers\PrediksiPenjualanController;
use App\Http\Controllers\UserAkunController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidasiController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::middleware(['guest'])->group(function(){
//     Route::get('/login',[SesiController::class,'index'])->name('login');
//     Route::post('/login',[SesiController::class,'login']);
// });

Auth::routes();

Route::get('/home', function(User $user){
    // return redirect('/admin');
    if ($user->role === 'admin') {
        // return redirect()->route('admin.dashboard');
        return redirect('admin');
    }else {
        // return redirect()->route('user.dashboard');
        return redirect('user');
    }
});
Route::get('/icon', function(){
    return view('admin.icon');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rute untuk pengguna terdaftar
// Route::middleware(['auth'])->group(function () {
// });

// Route::get('/contact' function(){
//     return view('user.contact');});
// Rute untuk pengguna admin
Route::middleware(['auth'])->group(function () {
    Route::get('/user', [UserDashboardController::class, 'index'])->middleware('userAkses:user');
    Route::get('/contact', [UserDashboardController::class, 'index2'])->middleware('userAkses:user');
    Route::get('/about', [UserDashboardController::class, 'about']);
    
    Route::get('/admin', [AdminDashboardController::class, 'index'])->middleware('userAkses:admin');
    Route::post('/admin/update/{id}', [AdminDashboardController::class, 'update'])->middleware('userAkses:admin');
    
    Route::resource('/userakun', UserAkunController::class)->middleware('userAkses:user');
    // Route::post('/editakun', [UserAkunController::class, 'store'])->middleware('userAkses:user');
    Route::post('/userakun/update/{id}', [UserAkunController::class, 'update'])->middleware('userAkses:user');
    
    Route::resource('/usermenu', UserDashboardController::class)->middleware('userAkses:user');
    
    // Route::get('/userpesanan', [PesananUserController::class, 'store'])->middleware('userAkses:user');
    Route::resource('/pesananuser', PesananUserController::class)->middleware('userAkses:user');
    Route::post('/userpesanan', [PesananUserController::class, 'store'])->middleware('userAkses:user');
    // Route::post('pesananuser/update/4', [PesananUserController::class, 'update']);
    // Route::get('/pesananuser/update/{id}', [PesananUserController::class, 'update'])->middleware('userAkses:user');
    // Route::post('/pesananuser/update/{id}', [PesananUserController::class, 'update'])->middleware('userAkses:user')->name('editpesananuser');
    Route::post('/pesananuser/update/{id}', [PesananUserController::class, 'update']);
    
    Route::resource('/pembayaranuser', PembayaranUserController::class)->middleware('userAkses:user');
    Route::post('/pembayaranuser/update/{id}', [PembayaranUserController::class, 'update'])->middleware('userAkses:user');
    
    Route::resource('/menu', MenuController::class)->middleware('userAkses:admin');
    Route::post('/postmenu', [MenuController::class, 'store'])->middleware('userAkses:admin');
    Route::post('/menu/update/{id}', [MenuController::class, 'update'])->middleware('userAkses:admin');
    
    // Route::resource('/pesanan', UserController::class)->middleware('userAkses:admin');
    Route::resource('/pesanan', PesananController::class)->middleware('userAkses:admin');
    Route::post('/postpesanan', [PesananController::class, 'store'])->middleware('userAkses:admin');
    Route::post('/pesanan/update/{id}', [PesananController::class, 'update'])->middleware('userAkses:admin');
    
    Route::get('/laporan', [PesananController::class, 'index2'])->middleware('userAkses:admin');
    Route::get('/laporan/cetak_pdf', [PesananController::class, 'cetak_pdf'])->middleware('userAkses:admin');
    
    Route::resource('/lababulanan', LabaBulananController::class)->middleware('userAkses:admin');
    
    // Route::get('/lababulanan', [LabaBulananController::class, 'index'])->middleware('userAkses:admin');
    Route::resource('/penjualanbulanan', PenjualanBulananController::class)->middleware('userAkses:admin');
    // Route::resource('/lababulanan', LabaBulananController::class)->middleware('userAkses:admin');
    // Route::get('/hasillababulanan', [LabaBulananController::class, 'create'])->middleware('userAkses:admin');
    // Route::post('/postlababulanan', [LabaBulananController::class, 'store'])->middleware('userAkses:admin');
    
    // Route::get('/prediksi', [PrediksiController::class, 'index'])->middleware('userAkses:admin');
    Route::resource('/prediksipenjualan', PrediksiPenjualanController::class)->middleware('userAkses:admin');
    Route::resource('/prediksilaba', PrediksiLabaController::class)->middleware('userAkses:admin');
    
    // Route::resource('/userdata', UserController::class)->middleware('userAkses:admin');
    Route::get('/datauser', [UserController::class, 'user'])->middleware('userAkses:admin');
    Route::post('/postuserdata', [UserController::class, 'store']);
    // Route::post('/postuserdata', [UserController::class, 'seve'])->middleware('userAkses:admin');
    // Route::get('detail/hapus/{id}', [UserController::class, 'detail']);
    Route::get('user/hapus/{id}', [UserController::class, 'hapus'])->middleware('userAkses:admin');
    // Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    // Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});
// Route::get('/menu', [MenuController::class, 'index']);

Route::middleware(['auth', 'auth.admin'])->group(function () {
    Route::resource('roles', RoleController::class)->except(['show']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'auth.user'])->group(function () {
    Route::get('/user/edit/password', [UserController::class, 'editPassword'])->name('user.edit.password');
    Route::post('/user/update/password', [UserController::class, 'updatePassword'])->name('user.update.password');
});
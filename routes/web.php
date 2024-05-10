<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengajuanTController;

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
    return view('login');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', function () {

        $data = DB::table('users')->where('status', '=', true)->get();
        if(auth()->user()->jabatan == 'staff') {
            $result = DB::table('pengajuan_t')->where('id' , '=' , auth()->user()->id)->get();
        } else {
            $result = DB::table('pengajuan_t')->get();
        }

        return view('home', compact('data', 'result'));

    })->name('home');
    
    Route::get('/pengajuan', function () {
        return view('pengajuan');
    })->name('pengajuan');
    
    // Route::get('/list', function () {
    //     return view('List');
    // });

    Route::post('/pengajuan/insertPengajuan', [PengajuanTController::class, 'insertPengajuan'])->name('insertPengajuan');

    Route::post('/pengajuan/updatePengajuan/{id}', [PengajuanTController::class, 'updatePengajuan'])->name('updatePengajuan');

    Route::post('/pengajuan/updatePengajuan2/{id}', [PengajuanTController::class, 'updatePengajuan2'])->name('updatePengajuan2');

});

Route::get('login', [AuthController::class,'index'])->name('login');

Route::get('register', [AuthController::class,'register'])->name('register');

Route::get('edit_user/{id}', [AuthController::class,'edit_user'])->name('edit_user');

Route::get('logout', [AuthController::class,'logout'])->name('logout');

Route::post('proses_login', [AuthController::class,'proses_login'])->name('proses_login');

Route::post('proses_register',[AuthController::class,'proses_register'])->name('proses_register');

Route::post('proses_edit_user/{id}',[AuthController::class,'proses_edit_user'])->name('proses_edit_user');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiemDanhController;
use App\Http\Controllers\LichController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;


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
    return view('layouts.app');
})->name('home');

Route::get('/diem-danh', [DiemDanhController::class, 'index'])->name('diem-danh');

Route::get('/dashboard', function () {
    return view('index');
})->name('dashboard');

Route::get('/phieu-danh-gia', function () {
    return view('phieu.index');
})->name('phieu-danh-gia');

Route::get('/lich-tuan', [LichController::class,'index'])->name('lich-tuan');

Route::get('/info',[TeacherController::class,'index'])->name('info');

Auth::routes();
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

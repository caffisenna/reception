<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/mypage', [App\Http\Controllers\MyPageController::class, 'index'])->name('mypage');
Route::get('/self', [App\Http\Controllers\MyPageController::class, 'self_absent'])->name('self_absent'); // 自己欠席入力
Route::get('/self_check_in', [App\Http\Controllers\Check_InController::class, 'self_check_in'])->name('self_check_in'); // 自己チェックイン

// 管理ユーザ用
Route::prefix('admin')->middleware('can:admin')->group(function () {
    Route::resource('participants', App\Http\Controllers\ParticipantController::class);
    Route::post('participants', [App\Http\Controllers\ParticipantController::class,'search'])->name('search');
    Route::resource('admin_staffinfos', App\Http\Controllers\AdminStaffinfoController::class);
});

// スタッフ用
Route::prefix('s')->middleware('can:staff')->group(function () {
    Route::get('/check_in', [App\Http\Controllers\Check_InController::class, 'index'])->name('check_in');
    Route::get('/check_in/input', [App\Http\Controllers\Check_InController::class, 'input'])->name('input');
    Route::post('/check_in/input', [App\Http\Controllers\Check_InController::class, 'input'])->name('input');
    Route::resource('staffinfos', App\Http\Controllers\StaffinfoController::class);
});

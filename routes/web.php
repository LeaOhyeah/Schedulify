<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminMasterController;
use App\Http\Controllers\AdminJurusanController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'loginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('password/reset', [ResetPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('password/email', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::middleware(['auth', 'admin_master'])->group(function () {
    Route::get('dashboard-master', [AdminMasterController::class, 'index']);
});

Route::middleware(['auth', 'admin_jurusan'])->group(function () {
    Route::get('dashboard-jurusan', [AdminJurusanController::class, 'index'])->name('admin_jurusan.index');  
    Route::get('dashboard-jurusan/agenda', [AdminJurusanController::class, 'agenda'])->name('agenda.index');  
    Route::get('dashboard-jurusan/agenda/baru', [AdminJurusanController::class, 'create'])->name('agenda.create');  

});

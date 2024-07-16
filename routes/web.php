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
    Route::get('dashboard-jurusan/agenda', [AdminJurusanController::class, 'meetings'])->name('admin_jurusan.meetings.index');
    Route::get('dashboard-jurusan/agenda-hari-ini', [AdminJurusanController::class, 'meetingsToday'])->name('admin_jurusan.meetings.today');
    Route::get('dashboard-jurusan/agenda-mendatang', [AdminJurusanController::class, 'meetingsUpcoming'])->name('admin_jurusan.meetings.upcoming');
    Route::get('dashboard-jurusan/agenda-riwayat', [AdminJurusanController::class, 'meetingsCompleted'])->name('admin_jurusan.meetings.completed');

    Route::get('dashboard-jurusan/agenda/create', [AdminJurusanController::class, 'create'])->name('admin_jurusan.meetings.create');
    Route::post('dashboard-jurusan/agenda/store/', [AdminJurusanController::class, 'store'])->name('admin_jurusan.meetings.store');
    Route::get('dashboard-jurusan/agenda/edit/{id}', [AdminJurusanController::class, 'edit'])->name('admin_jurusan.meetings.edit');
    Route::put('dashboard-jurusan/agenda/update/{id}', [AdminJurusanController::class, 'update'])->name('admin_jurusan.meetings.update');
    Route::delete('dashboard-jurusan/agenda/destory/{id}', [AdminJurusanController::class, 'destroy'])->name('admin_jurusan.meetings.destroy');
    
    Route::get('dashboard-jurusan/agenda/notulensi/create/{id}', [AdminJurusanController::class, 'minutes'])->name('admin_jurusan.minutes.create');
    Route::post('dashboard-jurusan/agenda/notulensi/store/{id}', [AdminJurusanController::class, 'minutesStore'])->name('admin_jurusan.minutes.store');
    Route::get('dashboard-jurusan/agenda/notulensi/edit/{id}', [AdminJurusanController::class, 'minutesEdit'])->name('admin_jurusan.minutes.edit');
    Route::put('dashboard-jurusan/agenda/notulensi/update/{id}', [AdminJurusanController::class, 'minutesUpdate'])->name('admin_jurusan.minutes.update');
    
    Route::get('dashboard-jurusan/agenda/notulensi/print/{id}', [AdminJurusanController::class, 'printMinutes'])->name('minutes.print');

    Route::get('dashboard-jurusan/agenda/dattarhadir/{id}', [AdminJurusanController::class, 'participant'])->name('admin_jurusan.participants.index');
});

Route::get('presensi-kehadiran/{hashid}', [AdminJurusanController::class, 'presensi'])->name('presensi.peserta');
Route::post('presensi-kehadiran/{hashid}', [AdminJurusanController::class, 'presensiStore'])->name('presensi.store');
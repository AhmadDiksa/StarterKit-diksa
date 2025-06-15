<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController; 
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Admin\DashboardController; // Akan kita buat
use App\Http\Controllers\PublicController;

// RUTE PUBLIK (BISA DIAKSES TANPA LOGIN)
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/berita/{slug}', [PublicController::class, 'show'])->name('berita.show.public');
Route::get('/kategori/{category:slug}', [PublicController::class, 'category'])->name('kategori.show.public');

// ... rute autentikasi bawaan breeze ...
require __DIR__.'/auth.php';

// RUTE AREA ADMIN/DASHBOARD (WAJIB LOGIN)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     // Rute untuk Wartawan
    Route::middleware(['role:Wartawan|Admin|Editor'])->group(function () {
        Route::resource('berita', BeritaController::class);
    });

    // Rute Approval untuk Editor
    Route::middleware(['role:Editor|Admin'])->group(function () {
        Route::patch('/berita/{berita}/approve', [BeritaController::class, 'approve'])->name('berita.approve');
        Route::patch('/berita/{berita}/reject', [BeritaController::class, 'reject'])->name('berita.reject');
    });
});

Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');


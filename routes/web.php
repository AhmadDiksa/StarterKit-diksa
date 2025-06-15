<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CategoryController; // Asumsi Anda membuat controller ini juga

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda bisa mendaftarkan semua rute untuk aplikasi web Anda.
| Rute-rute ini dimuat oleh RouteServiceProvider dan semuanya akan
| ditugaskan ke grup middleware "web".
|
*/

//=======================================================================
// 1. RUTE PUBLIK (BISA DIAKSES SIAPA SAJA TANPA LOGIN)
//=======================================================================

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/berita/{slug}', [PublicController::class, 'show'])->name('berita.show.public');
Route::get('/kategori/{category:slug}', [PublicController::class, 'category'])->name('kategori.show.public');


//=======================================================================
// 2. RUTE AUTENTIKASI (LOGIN, REGISTER, DLL.)
//=======================================================================
// Rute ini dihasilkan secara otomatis oleh Laravel Breeze.
// File auth.php berisi rute untuk login, register, forgot password, dll.
require __DIR__.'/auth.php';


//=======================================================================
// 3. RUTE AREA ADMIN/DASHBOARD (WAJIB LOGIN)
//=======================================================================
// Semua rute di dalam grup ini dilindungi oleh middleware 'auth' (harus login)
// dan 'verified' (email sudah terverifikasi).
Route::middleware(['auth', 'verified'])->group(function () {

    //-------------------------------------------------------------------
    // A. Rute Dashboard Utama
    //-------------------------------------------------------------------
    // Controller ini akan mengarahkan user ke dashboard yang sesuai dengan rolenya.
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //-------------------------------------------------------------------
    // B. Rute Profil User (untuk semua role yang login)
    //-------------------------------------------------------------------
    // Rute ini sudah disediakan oleh Breeze untuk edit profil user yang sedang login.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //-------------------------------------------------------------------
    // C. Rute Manajemen Berita
    //-------------------------------------------------------------------
    // Menggunakan prefix dan name group untuk menjaga kerapian.
    Route::prefix('berita')->name('berita.')->middleware('role:Admin|Editor|Wartawan')->group(function () {
        
        // Rute yang bisa diakses oleh semua role yang diizinkan (Admin, Editor, Wartawan)
        Route::get('/', [BeritaController::class, 'index'])->name('index');
        Route::get('/{berita}', [BeritaController::class, 'show'])->name('show');
        Route::get('/{berita}/edit', [BeritaController::class, 'edit'])->name('edit');
        Route::put('/{berita}', [BeritaController::class, 'update'])->name('update');
        Route::delete('/{berita}', [BeritaController::class, 'destroy'])->name('destroy');
        
        // Rute khusus untuk Wartawan & Admin untuk membuat berita
        Route::middleware('role:Wartawan|Admin')->group(function () {
            // URL diubah menjadi '/berita/new/create' untuk menghindari konflik dengan '/berita/{slug}'
            Route::get('/new/create', [BeritaController::class, 'create'])->name('create');
            Route::post('/', [BeritaController::class, 'store'])->name('store');
        });

        // Rute khusus untuk Editor & Admin untuk approval berita
        Route::middleware('role:Editor|Admin')->group(function () {
            Route::patch('/{berita}/approve', [BeritaController::class, 'approve'])->name('approve');
            Route::patch('/{berita}/reject', [BeritaController::class, 'reject'])->name('reject');
        });
    });

    //-------------------------------------------------------------------
    // D. Rute Manajemen Khusus Admin
    //-------------------------------------------------------------------
    // Grup ini berisi semua rute yang hanya boleh diakses oleh user dengan role 'Admin'.
    Route::middleware('role:Admin')->group(function () {
        
        // Manajemen User
        Route::resource('users', UserController::class);

        // Manajemen Kategori
        Route::resource('kategori', CategoryController::class)->except(['show']); // Tidak perlu halaman 'show' untuk kategori

    });

}); // Akhir dari grup middleware 'auth' & 'verified'
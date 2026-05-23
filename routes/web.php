<?php

use Illuminate\Support\Facades\Route;

// --- AUTH & DASHBOARD ---
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// --- ADMIN CONTROLLERS (Pake Alias) ---
use App\Http\Controllers\BeritaController as AdminBeritaController;
use App\Http\Controllers\PMBController as AdminPMBController;
use App\Http\Controllers\AlumniController as AdminAlumniController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\HomepageController; // Tambahan Controller Homepage
use App\Http\Controllers\AboutPageController;

// --- FRONTEND CONTROLLERS ---
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Frontend\PMBController;
use App\Http\Controllers\Frontend\AlumniController;

// ==========================================
// PUBLIC ROUTES (Frontend)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang', [AboutController::class, 'index'])->name('tentang');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('berita.detail');
Route::get('/pmb', [PMBController::class, 'index'])->name('pmb');
Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni');

// ==========================================
// GUEST ROUTES (Belum Login)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// ==========================================
// PROTECTED ROUTES (Hanya Admin)
// ==========================================
Route::middleware('auth')->group(function () {
    
    // Tombol Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Grouping khusus prefix /admin
    Route::prefix('admin')->group(function () {
        
        // Halaman Utama Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CMS Homepage
        Route::get('/homepage', [HomepageController::class, 'index'])->name('admin.homepage.index');
        Route::post('/homepage', [HomepageController::class, 'update'])->name('admin.homepage.update');

        // CMS Tentang Kami
        Route::get('/tentang', [AboutPageController::class, 'index'])->name('admin.about.index');
        Route::post('/tentang', [AboutPageController::class, 'update'])->name('admin.about.update');

        // CRUD Management Content
        Route::post('/berita/page-setting', [AdminBeritaController::class, 'updatePageSetting'])->name('admin.berita.page-setting.update');
        Route::post('/alumni/page-setting', [AdminAlumniController::class, 'updatePageSetting'])->name('admin.alumni.page-setting.update');
        Route::resource('berita', AdminBeritaController::class);
        Route::resource('alumni', AdminAlumniController::class);
        Route::resource('chatbot', ChatbotController::class);
        
        // PMB Khusus Update Konten (Single Page CMS)
        Route::get('/pmb', [AdminPMBController::class, 'index'])->name('admin.pmb.index');
        Route::post('/pmb', [AdminPMBController::class, 'update'])->name('admin.pmb.update');
        
    });
});

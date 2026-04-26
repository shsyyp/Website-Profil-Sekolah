<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PMBController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\ChatbotController;

// Route Beranda
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Route Tentang Kami
Route::get('/tentang', function () {
    return view('pages.tentang');
})->name('tentang');

// Route Berita (Dengan Mock Data)
Route::get('/berita', function () {
    
    // Data statis sebagai pengganti database sementara
    $daftar_berita = [
        (object)[
            'kategori' => 'Prestasi',
            'warna_badge' => 'bg-tertiary text-on-tertiary',
            'tanggal' => '24 Oktober 2023',
            'judul' => 'Tim Robotik SMAN Pintar Meraih Medali Emas di World Science Olympiad',
            'deskripsi' => 'Inovasi robot pembersih sungai karya siswa kelas XI berhasil memukau dewan juri internasional di Singapura...',
            'gambar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC-fxXC1lTd4v1iaEu5KWMaEHWsvicwpnaC1TDmEHM_lMS-mElSsYHAYPe8OFDP1EjI3RUr2shbnmvg51ZyJUSz1x16oA7WrCzVYf40Zo7hCpRU60hIfe6_prIMkR1pvODx9uFVV0PfHndpwfMbv5NSJ83Daod3ei52Skc_odv2I1m9emJ86wL9d302ZTjHn4dDIqvEgf25wVYzSGX5pveLIC4r1J8w228-ZTx0rlOXvV87u3DCFRDiPV9og-t3yiFrLdnxZwWyYdue'
        ],
        (object)[
            'kategori' => 'Kegiatan',
            'warna_badge' => 'bg-primary-container text-on-primary',
            'tanggal' => '20 Oktober 2023',
            'judul' => 'Pekan Seni Budaya: Menumbuhkan Kreativitas dalam Keberagaman',
            'deskripsi' => 'Festival tahunan yang menampilkan bakat seni dari musik tradisional hingga seni digital modern oleh seluruh siswa...',
            'gambar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD3iYlpCjU3hImMhAqClOnCUM3xge2OYFNuzXsw0b4VfMa7w0Mbku0IeKeuO9e4N4Feq3LETHDQo27_5BKWhvw0zv_KByrj1WDrFLWdSp2D8Xujd7fhLEm41vtj_Ibqoz2XejhcosgzcgJ_QsCTaB-mOEmWxT1mK0gLLVyJBqvNOhfxMLC15jJzcaOU2-jAgfSy60qnBp64vMmvJRgshYUTWjQf0RtBwi7oroaIl_v4diIbkZPd51-aB3iMgpAQU03H2g7vzWIxQT4b'
        ],
        (object)[
            'kategori' => 'Pengumuman',
            'warna_badge' => 'bg-error text-on-error',
            'tanggal' => '18 Oktober 2023',
            'judul' => 'Jadwal Ujian Tengah Semester Ganjil Tahun Ajaran 2023/2024',
            'deskripsi' => 'Diharapkan seluruh siswa mempersiapkan diri. Jadwal lengkap dapat diunduh melalui link berikut ini...',
            'gambar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD05D-InTA5esFmJ-v1KiqQ3KIgSNQtUyHjhJOfu1gs8BOy_cuVceQtUDfCic-rfTCSfMv7kK5xiShbOeqX7Ad0RmAgDCypkb7BmlbEnm7xJ5dDAxxdCersGX9aZAj-PFq-wkg_f1mTgrcwJ9RFkvJel7cCC4NMLGnZW6dyWo8G0VuGj3TulWkBCzVv1W-YZ6eKUXIKAXrtMwy0sDHrSSib5SuXy5eaxg6lz3d8eq43OTKkRIiN-3gTTky_826Vh9_OdvdyFYyjxrDw'
        ],
        (object)[
            'kategori' => 'Prestasi',
            'warna_badge' => 'bg-tertiary text-on-tertiary',
            'tanggal' => '15 Oktober 2023',
            'judul' => 'Lulusan SMAN Pintar Diterima di 10 Universitas Top Luar Negeri',
            'deskripsi' => 'Sebuah kebanggaan luar biasa, para alumni tahun ini berhasil menembus seleksi ketat di berbagai universitas ternama...',
            'gambar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC14vLmtPWRY0FPRz5r6mFPHXT-MrHBwYLgZNzRFsNLWuh37yG5ZzapCIbAnNeQCwk9GoEe40Yw3XOJn9JaCbGE3q-06ypvtbP2BnjETTvULfPzthgCuQOW0wSw3D_-eYl7eWohlx7kBHMRDYbUf5GjwfDx8c8zM7_Fjn6LAaV46puwDwD4Ax1AkX0n8XA36NanXpkKUFshuS_lE8WUM4qqGpQINq0qoaAM3TqXmgv1pHrUpX7JtxQgWB_4qRQf4PHV8z8W7fpC5rhk'
        ]
    ];

    // Melempar variabel $daftar_berita ke view pages.berita
    return view('pages.berita', compact('daftar_berita'));
    
})->name('berita');

// Route PMB (Dengan Mock Data Jadwal)
Route::get('/pmb', function () {
    
    // Data statis jadwal untuk dilooping di tabel
    $jadwal = [
        (object)[
            'kegiatan' => 'Pendaftaran Online', 
            'tanggal' => '1 Maret - 30 April 2025', 
            'keterangan' => 'Melalui website resmi'
        ],
        (object)[
            'kegiatan' => 'Seleksi Administrasi', 
            'tanggal' => '1 - 10 Mei 2025', 
            'keterangan' => 'Verifikasi berkas digital'
        ],
        (object)[
            'kegiatan' => 'Tes Potensi Akademik', 
            'tanggal' => '20 Mei 2025', 
            'keterangan' => 'Berbasis CBT di kampus'
        ],
        (object)[
            'kegiatan' => 'Wawancara & Psikotes', 
            'tanggal' => '22 - 23 Mei 2025', 
            'keterangan' => 'Dilakukan secara luring'
        ],
        (object)[
            'kegiatan' => 'Pengumuman Kelulusan', 
            'tanggal' => '1 Juni 2025', 
            'keterangan' => 'Via Dashboard PMB', 
            'is_highlight' => true // Flag untuk mengubah warna khusus di baris ini
        ]
    ];

    return view('pages.pmb', compact('jadwal'));
    
})->name('pmb');

// Route Alumni (Dengan Mock Data)
Route::get('/alumni', function () {
    
    // Data Dinamis 1: Lokasi Persebaran Map
    $lokasi = [
        (object)['kota' => 'JAKARTA', 'top' => '65%', 'left' => '75%', 'color' => 'bg-tertiary', 'ping' => true],
        (object)['kota' => 'LONDON', 'top' => '35%', 'left' => '45%', 'color' => 'bg-primary', 'ping' => false],
        (object)['kota' => 'TOKYO', 'top' => '42%', 'left' => '85%', 'color' => 'bg-primary', 'ping' => false],
    ];

    // Data Dinamis 2: Daftar Grid Profil Alumni
    $daftar_alumni = [
        (object)[
            'nama' => 'Andi Pratama', 'profesi' => 'Software Engineer at Google, Silicon Valley', 'tahun' => 'Class of 2012', 
            'badge' => 'Top Alumni', 'badge_color' => 'bg-blue-100 text-blue-700', 'gambar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCIZa_1c5EBChhfTSxTeSopq6QL9rywDlZrltkvpty1FXPbJY_MleyR8T0VF5GgIdFVsQpj8pLdY_DZpVuUgVmMoJnmBpqEtw3Lruueo_BUOfU03ZMFseeM98hZQ6TQcad1kWRn6hXTwvA8P5YQnZ4hs-jTe8M_cEB9HaKCERw1ytUCif3KOaML_7w0d5HcHPaF4QeEMp2gIPObu8TxCqLH3KkYVA435k3XxGsHngtznu1_KIE1Xiy68j-wMB_u4WeWohqCpQinI3Mg', 'tag' => 'Awardee'
        ],
        (object)[
            'nama' => 'Maya Lestari', 'profesi' => 'Analis Senior, Bank Indonesia', 'tahun' => 'Class of 2010', 
            'badge' => 'Lembaga Negara', 'badge_color' => 'bg-yellow-100 text-yellow-700', 'gambar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBs_pfQR2eHSHdiK6ZwTpfSJpbE1RR2REqRWUokj6YOcoWcH_j8V1dybCqrJlgBVze32I6xJSuJDPvyynsbjSfYnQ_3egPLXMJ3s-klgbt2AZ-FY5hvyWs5zU1yynFQO8kPQ9-mJysoJGWQp_OasdBP9a_YZfEWQ_DO3YKdTMV3ytX7BahGuF8PNJiC2fuvUcNLSrPzVw1w_IBUcWUZMtK1OoljLV7AjU6lYVSPZXrfty3yqt_fJeHzsyZ7ntiyfcbb_Ttw-F8YIPDe', 'tag' => 'Cum Laude'
        ],
        (object)[
            'nama' => 'Budi Santoso', 'profesi' => 'Founder, AgriTech Riau', 'tahun' => 'Class of 2015', 
            'badge' => 'Entrepreneur', 'badge_color' => 'bg-green-100 text-green-700', 'gambar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD0FjaVPT8k3Cx6-3LaO4cNzlz1mddo2gW41MfF08qW6Gh_AlLjTJdZHSwEicWs7sB2UCK23rWsTCsKfEf5Mfbcuqk-0axaIrlxjFs3aBGX5JWDFx7CuK2tyHclPk69OIUbUAz6xaym_xCQtfRqspl4_OTDl3TJkAk3oH_HL5x7Ict9yFGNGUVDWQDoKcXXpyQRY8SJ5FRG-LKER42R1O8LpxgzZM2jqnM7ZgU33W0Q_xdYdbJb6AIMr8fy1JptPwzJ1ijRyRRFdtKu', 'tag' => 'Startup Hero'
        ],
        (object)[
            'nama' => 'Rina Amelia', 'profesi' => 'Residen Bedah Syaraf, RSCM', 'tahun' => 'Class of 2011', 
            'gambar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDbBX0e6XXEJv4_QSOU6dUWLdix1HDg7zWu7E9UiU2_8u2cJuE-5JNDZAtxEDU3xf0Xa6BJyCtB1pFXVXrkbdws16ZV2KmP__qx73lJXH-tcysfXdpZA-pGAq22mFmqhkGsag4-70m99uokkoUIesgyi4QCdVLDBTo0g1Q3UZ4qkab2Q8mf03XT3Zmp87052JqxkrNLoYjMMSLD97Z6zl9YtEJfj_JvZFJkoU05DaYcizcVx5vKGOZJmoW_NY8DrJdCh-p04LhlFnZl'
        ],
        (object)[
            'nama' => 'Dedy Kurniawan', 'profesi' => 'Pilot, Garuda Indonesia', 'tahun' => 'Class of 2009', 
            'gambar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCpw4b2CXgbrYVhZLbuqkXuVMQ3ff8bwKTNLzSxVid49JTUeslUrIXq7nR6QjLbLO_aqsKAab54-Oo5364Lx7zDR9n3mqdyAOIfHMY8xtvB7YTR_5Sy273UsUJHeZHpytnqTCm6KHeYS4DD3nhbU18f9IN7LL8AtOQ5GbC4cVHF0AktZCpZgBcY55bUf20ax0sT71l6udb5eavsYF9I7X9tsaklaHRK7Au7FEnrnIwyKmXD8ZBGMwWS7VntVA2FMPGN_vw02_bvVxbK'
        ],
        (object)[
            'nama' => 'Siska Putri', 'profesi' => 'Creative Director, ArtHouse Singapore', 'tahun' => 'Class of 2014', 
            'gambar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCgx8F2vzGVdCDkoIxRThYe0mVxy1Z_CAwnhXfxwQajPBjrLZWRVCu4bBEXTrdnoNpx_enDZM6-srL7Fgadw2cjwjZVOmZU-xQlwhlYdvtJSpXLWm5qemKpKwG1SW2wv6kPyveXWhBbdqDCatyKiljIazPhtyweZHddvFtyPV9fyZVj0U93mmO3XjmBEVAcFn4q3oIZvkU_UlBoLd7U3fijZo_pgXB4MmvJOrxOZnxO-8WAvGlRnj0yihKJvmOQUl5LwD-zk0UZDHU1'
        ]
    ];

    return view('pages.alumni', compact('lokasi', 'daftar_alumni'));
    
})->name('alumni');

// --- GUEST ROUTES (Belum Login) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// --- PROTECTED ROUTES (Hanya untuk Admin yang sudah Login) ---
Route::middleware('auth')->group(function () {
    // Tombol Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Halaman Utama Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Management Content (Uncomment saat Controller sudah dibuat)
    Route::resource('/berita', BeritaController::class);
    Route::resource('alumni', AlumniController::class);
    
    // PMB Khusus Update Konten
    Route::get('/pmb', [PMBController::class, 'index'])->name('admin.pmb.index');
    Route::post('/pmb', [PMBController::class, 'update'])->name('admin.pmb.update');

    // Chatbot Management
    Route::resource('chatbot', ChatbotController::class);
});
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

// CONTROLLERS
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\JenisHewanController;
use App\Http\Controllers\RasHewanController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriKlinisController;
use App\Http\Controllers\KodeTindakanController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PerawatController;
use App\Http\Controllers\ResepsionisController;
use App\Http\Controllers\DataMasterController;
use App\Http\Controllers\TemuDokterController;
use App\Http\Controllers\PerawatPasienController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\PerawatJadwalController;
use App\Http\Controllers\DokterDashboardController;
use App\Http\Controllers\DokterPasienController;
use App\Http\Controllers\DokterRekamMedisController;
use App\Http\Controllers\DokterJadwalController;
use App\Http\Controllers\DokterJenisHewanController;
use App\Http\Controllers\DokterRasHewanController;
use App\Http\Controllers\PerawatRekamMedisController;
use App\Http\Controllers\ResepsionisProfileController;
use App\Http\Controllers\PemilikDashboardController;   // ⬅ DIPINDAHKAN KE SINI (FIX)
use App\Http\Controllers\PemilikTemuDokterController;   // ⬅ TAMBAHAN (WAJIB AGAR ROUTE DETAIL PEMILIK BERFUNGSI)
use App\Http\Controllers\JadwalPerawatController;
use App\Http\Controllers\JadwalDokterController;



/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/
Route::get('/', [SiteController::class, 'home'])->name('interface.home');

/*
|--------------------------------------------------------------------------
| AUTH — DIBENARKAN
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [SiteController::class, 'register'])->name('register');

/*
|--------------------------------------------------------------------------
| ⭐⭐⭐ ROUTE DATAMASTER DASHBOARD (DYNAMIC)
|--------------------------------------------------------------------------
*/
Route::get('/admin/datamaster', [DataMasterController::class, 'index'])
    ->name('admin.datamaster');

/*
|--------------------------------------------------------------------------
| ⭐⭐⭐ ALIAS ROUTE ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/admin/dashboard-alias', [DataMasterController::class, 'index'])
    ->name('interface.dashboard_admin');

/*
|--------------------------------------------------------------------------
| Layanan Umum
|--------------------------------------------------------------------------
*/
Route::view('/bedahhewan', 'bedahhewan')->name('interface.bedahhewan');
Route::view('/vaksinasi', 'vaksinasi')->name('interface.vaksinasi');
Route::view('/sterilisasi', 'sterilisasi')->name('interface.sterilisasi');
Route::view('/vaksinasi_sterilisasi', 'vaksinasi_sterilisasi')->name('interface.vaksinasi_sterilisasi');
Route::view('/visimisi', 'interface.visimisi')->name('interface.visimisi');
Route::view('/layanan', 'interface.layanan')->name('interface.layanan');
Route::view('/struktur', 'interface.struktur')->name('interface.struktur');
Route::view('/bedah-sterilisasi', 'bedahsterilisasi')->name('interface.bedah.sterilisasi');
Route::view('/bedah-minor', 'bedahminor')->name('interface.bedah.minor');
Route::view('/bedah-mayor', 'bedahmayor')->name('interface.bedah.mayor');
Route::view('/bedah-darurat', 'bedahdarurat')->name('interface.bedah.darurat');
Route::view('/bedah-gigimulut', 'bedahgigimulut')->name('interface.bedah.gigimulut');

/*
|--------------------------------------------------------------------------
| Dashboard role-based
|--------------------------------------------------------------------------
*/
Route::view('/dashboard', 'interface.dashboard')->name('interface.dashboard');
Route::view('/dashboard_dokter', 'interface.dashboard_dokter')->name('interface.dashboard_dokter');
Route::view('/dashboard_perawat', 'interface.dashboard_perawat')->name('interface.dashboard_perawat');


// === Manajemen Jadwal Perawat ===
Route::get('/admin/jadwal/perawat', [JadwalPerawatController::class, 'index'])->name('admin.jadwal.perawat');
Route::post('/admin/jadwal/perawat/store', [JadwalPerawatController::class, 'store'])->name('admin.jadwal.perawat.store');
Route::delete('/admin/jadwal/perawat/delete/{id}', [JadwalPerawatController::class, 'destroy'])->name('admin.jadwal.perawat.delete');

// === Manajemen Jadwal Dokter ===
Route::get('/admin/jadwal/dokter', [JadwalDokterController::class, 'index'])->name('admin.jadwal.dokter');
Route::post('/admin/jadwal/dokter/store', [JadwalDokterController::class, 'store'])->name('admin.jadwal.dokter.store');
Route::delete('/admin/jadwal/dokter/delete/{id}', [JadwalDokterController::class, 'destroy'])->name('admin.jadwal.dokter.delete');
Route::put('/admin/jadwal/dokter/update/{id}', 
    [JadwalDokterController::class, 'update']
)->name('admin.jadwal.dokter.update');


/*
|--------------------------------------------------------------------------
| ⭐ DASHBOARD PEMILIK — FIX
|--------------------------------------------------------------------------
*/
Route::get('/dashboard_pemilik', [PemilikDashboardController::class, 'index'])
    ->name('dashboard.pemilik');   // ⬅ FIX


/*
|--------------------------------------------------------------------------
| ⭐ ROUTE PROFIL PEMILIK (FIX FINAL)
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\PemilikProfileController;

Route::get('/pemilik/profile', [PemilikProfileController::class, 'index'])
    ->name('pemilik.profile');


/*
|--------------------------------------------------------------------------
| ⭐ ROUTE PROFIL PEMILIK LOGIN
|--------------------------------------------------------------------------
*/
Route::prefix('pemilik')->group(function () {

    Route::get('/profile', [App\Http\Controllers\PemilikProfileController::class, 'index'])
        ->name('pemilik.profile');
    
    Route::get('/temu-dokter/{id}', 
    [PemilikTemuDokterController::class, 'detail']
)->name('pemilik.temudokter.detail');


    Route::post('/profile/update', [App\Http\Controllers\PemilikProfileController::class, 'update'])
        ->name('pemilik.profile.update');

    Route::post('/profile/upload', [App\Http\Controllers\PemilikProfileController::class, 'uploadPhoto'])
        ->name('pemilik.profile.upload');

    Route::post('/profile/delete-photo', [App\Http\Controllers\PemilikProfileController::class, 'deletePhoto'])
        ->name('pemilik.profile.delete-photo');

    Route::get('/temu-dokter', [PemilikTemuDokterController::class, 'index'])
    ->name('pemilik.temudokter.index');   // ⬅ INI YANG WAJIB DITAMBAHKAN


    /*
    |--------------------------------------------------------------------------
    | ⭐⭐⭐ ROUTE DETAIL TEMU DOKTER UNTUK PEMILIK (BARU DITAMBAHKAN)
    |--------------------------------------------------------------------------
    */
    Route::get('/temu-dokter/{id}', 
        [PemilikTemuDokterController::class, 'detail']
    )->name('pemilik.temudokter.detail');   // ⬅ INI YANG MENGATASI ERROR-MU

});

/*
|--------------------------------------------------------------------------
| ⭐ FITUR PEMILIK — HEWAN SAYA
|--------------------------------------------------------------------------
*/
Route::get('/hewan', [App\Http\Controllers\PemilikHewanController::class, 'index'])
    ->name('pemilik.hewan.index');

/*
|--------------------------------------------------------------------------
| ⭐ FITUR PEMILIK — RIWAYAT KUNJUNGAN
|--------------------------------------------------------------------------
*/
Route::get('/kunjungan', [App\Http\Controllers\PemilikKunjunganController::class, 'index'])
    ->name('pemilik.kunjungan.index');

/*
|--------------------------------------------------------------------------
| ⭐ FITUR PEMILIK — REKAM MEDIS
|--------------------------------------------------------------------------
*/
Route::get('/rekam-medis', [App\Http\Controllers\PemilikRekamMedisController::class, 'index'])
    ->name('pemilik.rekammedis.index');

/*
|--------------------------------------------------------------------------
| ⭐⭐⭐ ROUTE DETAIL REKAM MEDIS PEMILIK (FIX ERROR)
|--------------------------------------------------------------------------
*/
Route::get('/rekam-medis/{id}', [App\Http\Controllers\PemilikRekamMedisController::class, 'detail'])
    ->name('pemilik.rekammedis.detail');




// ⭐ RESEPSIONIS DASHBOARD - FIX DENGAN CLOSURE
Route::get('/dashboard_resepsionis', function () {
    $total_antrian = \App\Models\TemuDokter::where('status', 'menunggu')->count();
    return view('interface.dashboard_resepsionis', compact('total_antrian'));
})->name('interface.dashboard_resepsionis');

// ⭐ ALIAS TAMBAHAN UNTUK FIX PROFIL RESEPSIONIS (DITAMBAHKAN TANPA MERUBAH APA PUN)
Route::get('/dashboard_resepsionis-alias', function () {
    $total_antrian = \App\Models\TemuDokter::where('status', 'menunggu')->count();
    return view('interface.dashboard_resepsionis', compact('total_antrian'));
})->name('interface.dashboard_resepsionis');

Route::get('/dashboard_resepsionis', function () {
    $total_antrian = \App\Models\TemuDokter::where('status', 'menunggu')->count();
    return view('interface.dashboard_resepsionis', compact('total_antrian'));
})->name('dashboard.resepsionis'); // ALIAS

/*
|--------------------------------------------------------------------------
| ⭐⭐⭐ ROUTE FIX PERAWAT
|--------------------------------------------------------------------------
*/
Route::get('/dashboard_perawat', function () {
    return view('interface.dashboard_perawat');
})->name('perawat.dashboard');
Route::view('/dashboard_perawat', 'interface.dashboard_perawat')->name('interface.dashboard_perawat');

Route::get('/perawat/pasien-static', function () {
    return view('perawat.pasien.data_pasien');
})->name('perawat.pasien.static');

Route::get('/perawat/pemeriksaan', [PemeriksaanController::class, 'index'])
    ->name('perawat.pemeriksaan.index');

Route::get('/perawat/jadwal', [PerawatJadwalController::class, 'index'])
    ->name('perawat.jadwal.index');

Route::post('/rekammedis/store', [PerawatRekamMedisController::class, 'store'])
        ->name('perawat.rekammedis.store');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    // ⭐⭐⭐ ROUTE PROFILE ADMIN (BARU DITAMBAHKAN)
    Route::get('/profile', [App\Http\Controllers\AdminProfileController::class, 'index'])
        ->name('admin.profile');
    Route::post('/profile/upload', [App\Http\Controllers\AdminProfileController::class, 'uploadPhoto'])
        ->name('admin.profile.upload');
    Route::post('/profile/delete-photo', [App\Http\Controllers\AdminProfileController::class, 'deletePhoto'])
        ->name('admin.profile.delete-photo');

    Route::get('/kategori/datakategori', [KategoriController::class, 'index'])->name('admin.kategori.data');
    Route::post('/kategori/datakategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::get('/kategori/delete/{id}', [KategoriKlinisController::class, 'destroy'])->name('admin.kategori.delete');

    Route::get('/kategoriklinis/datakategoriklinis', [KategoriKlinisController::class, 'index'])->name('admin.kategoriklinis.data');
    Route::post('/kategoriklinis/datakategoriklinis', [KategoriKlinisController::class, 'store'])->name('admin.kategoriklinis.store');
    Route::get('/kategoriklinis/edit/{id}', [KategoriKlinisController::class, 'edit'])->name('admin.kategoriklinis.edit');
    Route::post('/kategoriklinis/update/{id}', [KategoriKlinisController::class, 'update'])->name('admin.kategoriklinis.update');
    Route::get('/kategoriklinis/delete/{id}', [KategoriKlinisController::class, 'destroy'])->name('admin.kategoriklinis.delete');

    Route::get('/kodetindakan/datatindakan', [KodeTindakanController::class, 'index'])->name('admin.kodetindakan.data');
    Route::post('/kodetindakan/store', [KodeTindakanController::class, 'store'])->name('admin.kodetindakan.store');
    Route::get('/kodetindakan/delete/{id}', [KodeTindakanController::class, 'delete'])->name('admin.kodetindakan.delete');
    Route::view('/kodetindakan/tambahkodetindakan', 'admin.kodetindakan.tambahkodetindakan')->name('admin.kodetindakan.tambah');
    Route::view('/kodetindakan/editkodetindakan', 'admin.kodetindakan.editkodetindakan')->name('admin.kodetindakan.edit');
    Route::post('/admin/kodetindakan/update/{id}', [KodeTindakanController::class, 'update'])->name('admin.kodetindakan.update');

    Route::get('/role/manajemenrole', [RoleController::class, 'index'])->name('admin.role.manajemen');
    Route::post('/role/datarole', [RoleController::class, 'store'])->name('admin.role.store');
    Route::delete('/role/hapus/{idrole}', [RoleController::class, 'destroy'])->name('admin.role.delete');
    Route::view('/role/tambahrole', 'admin.role.tambahrole')->name('admin.role.tambah');
    Route::get('/role/edit/{idrole}', [RoleController::class, 'edit'])->name('admin.role.edit');
    Route::post('/role/update/{idrole}', [RoleController::class, 'update'])->name('admin.role.update');
    Route::delete('/role/delete-all/{iduser}', [RoleController::class, 'deleteAll'])->name('admin.role.deleteAll');

    Route::get('/user/datauser', [UserController::class, 'index'])->name('admin.user.data');
    Route::post('/user/datauser/update', [UserController::class, 'update'])->name('admin.user.update');

    Route::view('/user/edituser', 'admin.user.edituser')->name('admin.user.edit');
    Route::view('/user/resetpw', 'admin.user.resetpw')->name('admin.user.resetpw');

    Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::get('/user/tambahuser', [UserController::class, 'create'])->name('admin.user.tambah');
    Route::post('/user/tambahuser', [UserController::class, 'store'])->name('admin.user.store');

    Route::get('/user/reset/{id}', [UserController::class, 'resetPassword'])->name('admin.user.reset');
    Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
});

/*
|--------------------------------------------------------------------------
| CRUD Dokter / Perawat / Resepsionis
|--------------------------------------------------------------------------
*/
Route::prefix('admin/datamaster')->group(function () {

    Route::get('/dokter', [DokterController::class, 'index'])->name('admin.dokter.index');
    Route::get('/dokter/create', [DokterController::class, 'create'])->name('admin.dokter.create');
    Route::post('/dokter/store', [DokterController::class, 'store'])->name('admin.dokter.store');
    Route::get('/dokter/edit/{id}', [DokterController::class, 'edit'])->name('admin.dokter.edit');
    Route::post('/dokter/update/{id}', [DokterController::class, 'update'])->name('admin.dokter.update');
    Route::get('/dokter/delete/{id}', [DokterController::class, 'destroy'])->name('admin.dokter.delete');

    Route::get('/perawat', [PerawatController::class, 'index'])->name('admin.perawat.index');
    Route::get('/perawat/create', [PerawatController::class, 'create'])->name('admin.perawat.create');
    Route::post('/perawat/store', [PerawatController::class, 'store'])->name('admin.perawat.store');
    Route::get('/perawat/edit/{id}', [PerawatController::class, 'edit'])->name('admin.perawat.edit');
    Route::post('/perawat/update/{id}', [PerawatController::class, 'update'])->name('admin.perawat.update');
    Route::get('/perawat/delete/{id}', [PerawatController::class, 'destroy'])->name('admin.perawat.delete');

    Route::get('admin/perawat/reset/{id}', [PerawatController::class, 'reset'])->name('admin.perawat.reset');

    Route::get('/resepsionis', [ResepsionisController::class, 'index'])->name('admin.resepsionis.index');
    Route::get('/resepsionis/create', [ResepsionisController::class, 'create'])->name('admin.resepsionis.create');
    Route::post('/resepsionis/store', [ResepsionisController::class, 'store'])->name('admin.resepsionis.store');
    Route::get('/resepsionis/edit/{id}', [ResepsionisController::class, 'edit'])->name('admin.resepsionis.edit');
    Route::post('/resepsionis/update/{id}', [ResepsionisController::class, 'update'])->name('admin.resepsionis.update');
    Route::get('/resepsionis/delete/{id}', [ResepsionisController::class, 'destroy'])->name('admin.resepsionis.delete');

    Route::get('/resepsionis/reset/{id}', [ResepsionisController::class, 'reset'])->name('admin.resepsionis.reset');
    Route::post('/user/status/{id}', [UserController::class, 'toggleStatus'])->name('admin.user.toggleStatus');

    // ⭐ ROUTE FIX KIRIM DATA KE DASHBOARD RESEPSIONIS
    Route::get('/dashboard_resepsionis_data', [ResepsionisController::class, 'dashboardResepsionis'])
        ->name('dashboard.resepsionis.data');

    Route::get('/dashboard_resepsionis', function () {
        $total_antrian = \App\Models\TemuDokter::where('status', 'Menunggu')->count();
        return view('interface.dashboard_resepsionis', compact('total_antrian'));
    })->name('dashboard.resepsionis');

});

/*
|--------------------------------------------------------------------------
| DOKTER ROUTES — FIXED & CLEAN
|--------------------------------------------------------------------------
*/
Route::prefix('dokter')->group(function () {

    // JADWAL
    Route::view('/jadwal/jadwal_pemeriksaan', 'dokter.jadwal.jadwal_pemeriksaan')
        ->name('dokter.jadwal');
    Route::get('/dokter/rekammedis/detailrekammedis', [DokterRekamMedisController::class, 'detailQuery'])
        ->name('dokter.rekammedis.detailquery');


    // JENIS HEWAN
    Route::get('/jenis/datajenishewan', [JenisHewanController::class, 'index'])->name('dokter.jenis.data');
    Route::post('/jenis/datajenishewan', [JenisHewanController::class, 'store'])->name('dokter.jenis.store');
    Route::get('/jenis/edit/{id}', [JenisHewanController::class, 'edit'])->name('dokter.jenis.edit');
    Route::get('/jenis/create', [JenisHewanController::class, 'create'])->name('dokter.jenis.create');
    Route::post('/jenis/update/{id}', [JenisHewanController::class, 'update'])->name('dokter.jenis.update');
    Route::get('/jenis/hapus/{id}', [JenisHewanController::class, 'destroy'])->name('dokter.jenis.delete');

    // PROFILE
    Route::get('/profile', [App\Http\Controllers\DokterProfileController::class, 'index'])
        ->name('dokter.profile');
    Route::post('/profile/upload', [App\Http\Controllers\DokterProfileController::class, 'uploadPhoto'])
        ->name('dokter.profile.upload');
    Route::post('/profile/delete-photo', [App\Http\Controllers\DokterProfileController::class, 'deletePhoto'])
        ->name('dokter.profile.delete-photo');

    // RAS HEWAN
    Route::get('/ras/datarashewan', [RasHewanController::class, 'index'])->name('dokter.ras.data');
    Route::post('/ras/datarashewan', [RasHewanController::class, 'store'])->name('dokter.ras.store');
    Route::get('/ras/create', [RasHewanController::class, 'create'])->name('dokter.ras.create');
    Route::get('/ras/edit/{id}', [RasHewanController::class, 'edit'])->name('dokter.ras.edit');
    Route::post('/ras/update/{id}', [RasHewanController::class, 'update'])->name('dokter.ras.update');
    Route::get('/ras/delete/{id}', [RasHewanController::class, 'destroy'])->name('dokter.ras.delete');

    // PASIEN
    Route::view('/pasien/datapasiendokter', 'dokter.pasien.datapasiendokter')->name('dokter.pasien');

});

/*
|--------------------------------------------------------------------------
| ⭐⭐⭐ TAMBAHAN ROUTE DOKTER
|--------------------------------------------------------------------------
*/
Route::get('/dokter/rekam-medis', [DokterRekamMedisController::class, 'index'])
    ->name('dokter.rekammedis.index');

Route::get('/dokter/rekam-medis/{id}', [DokterRekamMedisController::class, 'detail'])
    ->name('dokter.rekammedis.detail');

Route::get('/dokter/pasien', [DokterPasienController::class, 'index'])
    ->name('dokter.pasien.index');

Route::post('/dokter/rekam-medis/store', [DokterRekamMedisController::class, 'store'])
    ->name('dokter.rekammedis.store');

Route::get('/dokter/rekam-medis/{id}', 
    [App\Http\Controllers\DokterRekamMedisController::class, 'detail']
)->name('dokter.rekammedis.detail');

/*
|--------------------------------------------------------------------------
| ❗ PERBAIKAN UTAMA — ROUTE JADWAL DOKTER
|--------------------------------------------------------------------------
*/
Route::get('/dokter/jadwal', [DokterJadwalController::class, 'index'])
    ->name('dokter.jadwal.index');

/*
|--------------------------------------------------------------------------
| ❗ FIX PERBAIKAN VIEW — HARUS SAMA DENGAN NAMA FILE KAMU
|--------------------------------------------------------------------------
*/
Route::get('/dokter/jenis-hewan', [DokterJenisHewanController::class, 'index'])
    ->name('dokter.jenishewan.index');

Route::get('/dokter/ras-hewan', [DokterRasHewanController::class, 'index'])
    ->name('dokter.rashewan.index');

/*
|--------------------------------------------------------------------------
| ❗ ROUTE DETAIL PASIEN — FIX ERROR
|--------------------------------------------------------------------------
*/
Route::get('/dokter/pasien/{id}', [DokterPasienController::class, 'detail'])
    ->name('dokter.pasien.detail');

/*
|--------------------------------------------------------------------------
| ❗❗❗ ROUTE STORE REKAM MEDIS DOKTER (PERBAIKAN UTAMA)
|--------------------------------------------------------------------------
*/
Route::post('/dokter/rekam-medis/store', [DokterRekamMedisController::class, 'store'])
    ->name('dokter.rekammedis.store');

/*
|--------------------------------------------------------------------------
| PERAWAT ROUTES (FINAL FIX)
|--------------------------------------------------------------------------
*/
Route::prefix('perawat')->group(function () {

    Route::get('/dashboard', function () {
        return view('interface.dashboard_perawat');
    })->name('perawat.dashboard');

    Route::get('/pasien', [PerawatPasienController::class, 'index'])
        ->name('perawat.pasien.index');

    Route::get('/pemeriksaan', [PemeriksaanController::class, 'index'])
        ->name('perawat.pemeriksaan.index');

    Route::post('/pemeriksaan/store', 
        [PemeriksaanController::class, 'store'])
        ->name('perawat.pemeriksaan.store');

    /*
     * ⭐⭐⭐ ROUTE DETAIL — INI YANG KITA TAMBAHKAN
     */
    Route::get('/pemeriksaan/{id}/detail', 
        [PemeriksaanController::class, 'detail'])
        ->name('perawat.pemeriksaan.detail');

    Route::get('/jadwal', [PerawatJadwalController::class, 'index'])
        ->name('perawat.jadwal.index');

    Route::view('/rekammedis/data', 'perawat.rekammedis.datarekammedis')
        ->name('perawat.rekammedis.data');

    Route::get('/rekammedis/input', [RekamMedisController::class, 'create']) ->
        name('perawat.rekammedis.input');

    Route::post('/rekammedis/store', [RekamMedisController::class, 'store'])
        ->name('perawat.rekammedis.store');

    Route::view('/rekammedis/proses', 'perawat.rekammedis.prosesinput')
        ->name('perawat.rekammedis.proses');

    // ⭐⭐⭐ ROUTE PROFILE PERAWAT (BARU DITAMBAHKAN)
    Route::get('/profile', [App\Http\Controllers\PerawatProfileController::class, 'index'])
        ->name('perawat.profile');
    Route::post('/profile/upload', [App\Http\Controllers\PerawatProfileController::class, 'uploadPhoto'])
        ->name('perawat.profile.upload');
    Route::post('/profile/delete-photo', [App\Http\Controllers\PerawatProfileController::class, 'deletePhoto'])
        ->name('perawat.profile.delete-photo');
});

/*
|--------------------------------------------------------------------------
| ROUTE PERAWAT PASIEN (HARUS DI LUAR PREFIX!)
|--------------------------------------------------------------------------
*/
Route::get('/perawat/pasien', [PerawatPasienController::class, 'index'])
    ->name('perawat.pasien.index');

/*
|--------------------------------------------------------------------------
| RESEPSIONIS ROUTES (FULL CRUD UNTUK RESEPSIONIS)
|--------------------------------------------------------------------------
*/
Route::prefix('resepsionis')->group(function () {

    // ⭐⭐⭐ ROUTE PROFILE RESEPSIONIS (BARU DITAMBAHKAN) ⭐⭐⭐
    Route::get('/profile', [ResepsionisProfileController::class, 'index'])
        ->name('resepsionis.profile');
    Route::post('/profile/upload', [ResepsionisProfileController::class, 'uploadPhoto'])
        ->name('resepsionis.profile.upload');
    Route::post('/profile/delete-photo', [ResepsionisProfileController::class, 'deletePhoto'])
        ->name('resepsionis.profile.delete-photo');

    Route::get('/pemilik/regrispemilik', [PemilikController::class, 'formRegistrasi'])
        ->name('resepsionis.pemilik.regris');

    Route::get('/pemilik/datapemilik', [PemilikController::class, 'index'])
        ->name('resepsionis.pemilik');

    Route::post('/pemilik/datapemilik', [PemilikController::class, 'store'])
        ->name('resepsionis.pemilik.store');

    Route::post('/pemilik/update/{id}', [PemilikController::class, 'update'])
        ->name('resepsionis.pemilik.update');

    Route::delete('/pemilik/delete/{id}', [PemilikController::class, 'destroy'])
        ->name('resepsionis.pemilik.delete');

    /*
    | PET
    */
    Route::get('/pet/regrispet', [PetController::class, 'regrispet'])
        ->name('resepsionis.pet.regris');

    Route::get('/pet/datapet', [PetController::class, 'indexResepsionis'])
        ->name('resepsionis.pet');

    Route::post('/pet/datapet', [PetController::class,
        'store'])->name('resepsionis.pet.store');

    Route::get('/pet/edit/{id}', [PetController::class, 'edit'])
        ->name('resepsionis.pet.edit');

    Route::post('/pet/update/{id}', [PetController::class, 'update'])
        ->name('resepsionis.pet.update');

    Route::get('/pet/delete/{id}', [PetController::class, 'destroy'])
        ->name('resepsionis.pet.delete');

    Route::get('/pet/create', [PetController::class, 'create'])
        ->name('resepsionis.pet.create');
    
    Route::get('/pet/get/{id}', [PetController::class, 'getPet'])
        ->name('resepsionis.pet.get');

    /*
    | TEMU DOKTER
    */
    Route::get('/temudokter/temudokter', [TemuDokterController::class, 'index'])
        ->name('resepsionis.temudokter');

    Route::post('/temudokter/store', [TemuDokterController::class, 'store'])
        ->name('resepsionis.temudokter.store');

    Route::post('/temudokter/update/{id}', [TemuDokterController::class, 'update'])
        ->name('resepsionis.temudokter.update');

    Route::get('/temudokter/delete/{id}', [TemuDokterController::class, 'destroy'])
        ->name('resepsionis.temudokter.delete');

    // DUMMY ROUTES UNTUK MENU SIDEBAR (sesuaikan nanti dengan controller sebenarnya)
    Route::view('/pendaftaran', 'resepsionis.pendaftaran.index')->name('resepsionis.pendaftaran.index');
    Route::view('/pasien', 'resepsionis.pasien.index')->name('resepsionis.pasien.index');
    Route::view('/jadwal', 'resepsionis.jadwal.index')->name('resepsionis.jadwal.index');
    Route::view('/pembayaran', 'resepsionis.pembayaran.index')->name('resepsionis.pembayaran.index');
});

/* ===========================================================
   AJAX — Ambil Dokter yang Tersedia Berdasarkan Tanggal Pilihan
=========================================================== */
Route::get('/ajax/get-dokter-by-date', [TemuDokterController::class, 'getDokterByDate'])
    ->name('ajax.getDokterByDate');

/* ===========================================================
   ROUTE TAMBAHAN — AGAR AJAX DI TEMU DOKTER BERHASIL
=========================================================== */
Route::get('/resepsionis/temudokter/dokter-by-date', 
    [TemuDokterController::class, 'getDokterByDate']
)->name('resepsionis.temudokter.bydate');


Route::prefix('perawat')->group(function () {

    Route::get('/pemeriksaan', [PemeriksaanController::class, 'index'])
    ->name('perawat.pemeriksaan.index');

    Route::get('/pemeriksaan/{id}/edit', 
        [PemeriksaanController::class, 'edit'])
        ->name('perawat.pemeriksaan.edit');

    Route::post('/pemeriksaan/{id}/update', 
        [PemeriksaanController::class, 'update'])
        ->name('perawat.pemeriksaan.update');

    Route::get('/pemeriksaan/{id}/delete', 
        [PemeriksaanController::class, 'destroy'])
        ->name('perawat.pemeriksaan.delete');
});

/*
|--------------------------------------------------------------------------
| PATCH — Disable timestamps jika column tidak ada
|--------------------------------------------------------------------------
*/
use App\Models\User;
if (class_exists(User::class)) {
    User::saving(function ($model) {
        if (!Schema::hasColumn($model->getTable(), 'created_at')) {
            $model->timestamps = false;
        }
    });
}

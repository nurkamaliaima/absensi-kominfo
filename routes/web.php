<?php

use Illuminate\Support\Facades\Route;

/** Route for frontend */
Route::get('/', 'user\AuthController@index');
Route::prefix('user')->group(function () {
    Route::post('/login', 'user\AuthController@doLogin');
    Route::get('/home', 'user\HomeController@index');
    Route::get('/logout', 'user\AuthController@logout');
    Route::get('/about', 'user\HomeController@about');
    Route::get('/guide', 'user\HomeController@guide');
    Route::get('/concession', 'user\HomeController@concession');
    Route::post('/concession', 'user\HomeController@store_concession');
    Route::get('/history', 'user\HomeController@show_history');
    Route::get('/attendance', 'user\HomeController@attendance');
    // Route::post('/doAttendance', 'user\HomeController@do_attendance');
});

// Route::post('user/login', 'user\AuthController@doLogin');
// Route::get('user/home', 'user\HomeController@index');
// Route::get('user/logout', 'user\AuthController@logout');
// Route::get('user/about', 'user\HomeController@about');
// Route::get('user/guide', 'user\HomeController@guide');
// Route::get('user/concession', 'user\HomeController@concession');
// Route::post('user/concession', 'user\HomeController@store_concession');
// Route::get('user/history', 'user\HomeController@show_history');
// Route::get('user/attendance', 'user\HomeController@attendance');
Route::post('/doAttendance', 'user\HomeController@do_attendance');

/** Route for backend */
Route::get('/admin', 'AuthController@index')->name('admin.login');
Route::get('register', 'AuthController@register');
Route::post('register', 'AuthController@doRegister');
Route::post('login', 'AuthController@doLogin');

use App\Http\Controllers\LaporanController;

Route::get('laporan/harian', [LaporanController::class, 'laporanHarian'])->name('laporan.harian');
Route::get('laporan/bulanan', [LaporanController::class, 'laporanBulanan'])->name('laporan.bulanan');
Route::get('laporan/tidakhadir', [LaporanController::class, 'laporanTidakHadir'])->name('laporan.tidakhadir');
Route::get('laporan/terlambat', [LaporanController::class, 'laporanTerlambat'])->name('laporan.terlambat');
Route::get('laporan/jamkerja', [LaporanController::class, 'laporanJamKerja'])->name('laporan.jamkerja');
Route::get('/laporan/gabungan', [LaporanController::class, 'laporanGabungan'])->name('laporan.gabungan');


// Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'DashboardController@index');
    Route::get('logout', 'AuthController@logout');
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
    Route::resource('attendance', 'AttendanceController');
    Route::resource('concession', 'ConcessionController');
// });

Route::prefix('instansi')->name('instansi.')
->controller(InstansiController::class)
->group(function () {
    Route::get('/', 'index')->name('index');
});

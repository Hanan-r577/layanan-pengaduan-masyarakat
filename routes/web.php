<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LampiranController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\StatusPengaduanController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
| PUBLIC (Guest & Auth)
|--------------------------------------------------------------------------
*/

Route::get('/', [MasyarakatController::class, 'index'])
    ->name('masyarakat.index');

Route::get('/register', [RegisteredUserController::class, 'show'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::post('/chat/start', [ChatController::class, 'start'])
    ->name('chat.start');

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (AUTH)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/chat/send', [ChatController::class, 'send'])
        ->name('chat.send');

    Route::get('/chat/messages/{id}', [ChatController::class, 'messages'])
        ->name('chat.messages');

    Route::get('/chat/get-session', [ChatController::class, 'getSession'])
        ->name('chat.getSession');

    Route::get('/my_account', [\App\Http\Controllers\MyAccountController::class, 'index'])
        ->name('my.account');

    Route::post('/my_account', [\App\Http\Controllers\MyAccountController::class, 'update'])
        ->name('my.account.update');

    Route::get('/lapor/create', [PengaduanController::class, 'createMasyarakat'])
        ->name('masyarakat.pengaduan.create');

    Route::post('/lapor', [PengaduanController::class, 'storeMasyarakat'])
        ->name('masyarakat.pengaduan.store');

    Route::get('/pengaduan-saya', [PengaduanController::class, 'masyarakatIndex'])
        ->name('pengaduan.masyarakat.index');

    Route::get('/pengaduan-saya/{pengaduan}', [PengaduanController::class, 'masyarakatShow'])
        ->name('pengaduan.masyarakat.show');

    Route::post('/pengaduan/{id}/komplain', [PengaduanController::class, 'komplain'])
        ->name('pengaduan.komplain');

    // Logout (WAJIB DI SINI)
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    })->name('logout');

});

Route::middleware(['auth', 'level:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Master Data
    Route::resource('user', UserController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('statusPengaduan', StatusPengaduanController::class);

    // Pengaduan Admin
    Route::resource('pengaduan', PengaduanController::class);
    Route::resource('tanggapan', TanggapanController::class);

    Route::get('/chat', [ChatController::class, 'indexAdmin'])
        ->name('admin.chat.index');

    Route::get('/chat/{id}', [ChatController::class, 'showAdmin'])
        ->name('admin.chat.show');

    Route::post('/chat/reply', [ChatController::class, 'replyAdmin'])
        ->name('admin.chat.reply');

    Route::get(
        'pengaduan/{pengaduan}/tanggapan',
        [PengaduanController::class, 'tanggapan']
    )->name('pengaduan.tanggapan');

    Route::post(
        'pengaduan/{pengaduan}/tanggapan',
        [PengaduanController::class, 'tanggapanStore']
    )->name('pengaduan.tanggapanStore');

    Route::post('/pengaduan/{id}/tolak', [PengaduanController::class, 'tolak'])
        ->name('pengaduan.tolak');

    Route::get(
        'pengaduan/{pengaduan}/detail',
        [PengaduanController::class, 'detail']
    )->name('pengaduan.detail');

    // Lampiran
    Route::post(
        '/pengaduan/{pengaduan}/lampiran',
        [LampiranController::class, 'store']
    )->name('lampiran.store');

    Route::put(
        '/lampiran/{lampiran}',
        [LampiranController::class, 'update']
    )->name('lampiran.update');

    Route::delete(
        '/lampiran/{lampiran}',
        [LampiranController::class, 'destroy']
    )->name('lampiran.destroy');

    Route::put('/admin/chat/{id}/close', [ChatController::class, 'close'])
        ->name('admin.chat.close');

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

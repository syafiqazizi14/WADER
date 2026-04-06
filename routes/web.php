<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ChatRequestController as AdminChatRequestController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\ServiceLinkController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StatistikMojokertoItemController;
use App\Http\Controllers\ChatRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SiteComplaintController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('site.home');
Route::get('/jenis-pelayanan', [SiteController::class, 'chat'])->name('site.chat');
Route::get('/pengaduan', [SiteComplaintController::class, 'show'])->name('site.complaints');
Route::post('/chat-requests', [ChatRequestController::class, 'store'])->name('chat-requests.store');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:superadmin,editor'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('pages', PageController::class)->except(['show']);
    Route::resource('sections', PageSectionController::class)->except(['show']);
    Route::resource('service-links', ServiceLinkController::class)->except(['show']);
    Route::resource('statistik-mojokerto', StatistikMojokertoItemController::class)
        ->except(['show'])
        ->parameters(['statistik-mojokerto' => 'item']);
    Route::resource('media', MediaController::class)->only(['index', 'store', 'destroy']);
    Route::get('/chat-requests/export', [AdminChatRequestController::class, 'export'])->name('chat-requests.export');
    Route::get('/export/pelayanan-pengaduan', [ExportController::class, 'pelayananPengaduan'])->name('export.pelayanan-pengaduan');
    Route::resource('chat-requests', AdminChatRequestController::class)->only(['index', 'show']);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/pst-center', [SiteController::class, 'show'])
    ->defaults('slug', 'pst-center')
    ->name('site.pst-center');

Route::get('/pss', [SiteController::class, 'pss'])
    ->name('site.pss');

Route::get('/{slug}', [SiteController::class, 'show'])
    ->where('slug', '[A-Za-z0-9\-]+')
    ->name('site.page');

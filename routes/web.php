<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ClientLogoController;
use App\Http\Controllers\Admin\CompanyQualityController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\ContactController as SiteContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Site Público (Landing Page)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::post('/contato', [SiteContactController::class, 'store'])
    ->middleware('throttle:contact-form')
    ->name('contact.store');

/*
|--------------------------------------------------------------------------
| Autenticação
|--------------------------------------------------------------------------
*/

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::get('/login', 'login')->middleware('guest')->name('login');
    Route::post('/login', 'login_store')->middleware('guest')->name('login.store');
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');

    Route::get('/google/redirect', 'google_redirect')->name('auth.google.redirect');
    Route::get('/google/callback', 'google_callback')->name('auth.google.callback');
});

/*
|--------------------------------------------------------------------------
| Painel Administrativo
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('reorder', \App\Http\Controllers\Admin\ReorderController::class)->name('reorder');

    Route::resource('banners', BannerController::class)->except(['show']);
    Route::resource('services', AdminServiceController::class)->except(['show']);

    Route::delete(
        'portfolios/{portfolio}/images/{image}',
        [PortfolioController::class, 'destroyImage']
    )->name('portfolios.images.destroy');
    Route::resource('portfolios', PortfolioController::class)->except(['show']);

    Route::resource('company-qualities', CompanyQualityController::class)
        ->except(['show'])
        ->parameters(['company-qualities' => 'companyQuality']);

    Route::resource('gallery', GalleryImageController::class)
        ->except(['show'])
        ->parameters(['gallery' => 'gallery']);

    Route::resource('client-logos', ClientLogoController::class)
        ->except(['show'])
        ->parameters(['client-logos' => 'clientLogo']);

    Route::resource('testimonials', TestimonialController::class)->except(['show']);

    Route::get('site-settings', [SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::put('site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');

    Route::resource('contact-messages', ContactMessageController::class)
        ->only(['index', 'show', 'destroy']);

    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('/', 'index')->name('profile');
    });
});

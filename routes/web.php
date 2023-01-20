<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\SocialiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SocialiteController::class, 'index']);

Route::group(['prefix' => 'auth'], function(){
    Route::get('login', [SocialiteController::class, 'index'])->name('login');
    Route::post('login', [SocialiteController::class, 'login'])->name('login.post');
    Route::get('register', [SocialiteController::class, 'register'])->name('register');
    Route::get('github', [SocialiteController::class, 'gitRedirected']);
    Route::get('callback', [SocialiteController::class, 'authCallback']);
});

Route::group(['middleware' => 'auth'], function(){
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/profile', 'profile')->name('profile');
        Route::put('/profile/social-media', 'updateSocialMedia')->name('social-media.update');
        Route::put('/profile/amount-setting', 'updateAmountSetting')->name('amount-setting.update');
        Route::put('/profile/update-profile', 'updateProfile')->name('profile.update');
        Route::put('/profile/update-password', 'updatePassword')->name('password.update');
    });
    Route::get('logout', [SocialiteController::class, 'logout'])->name('logout');

    Route::controller(DonationController::class)->group(function () {
        Route::get('/donation-list', 'index')->name('donation.index');
    });
    Route::get('/donate/{name}', [DonationController::class, 'donatePage'])->name('donation.donate-action');
    Route::post('pay-donate', [DonationController::class, 'payDonation'])->name('donation.pay');
});

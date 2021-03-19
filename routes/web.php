<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\IndexController;
use App\Rights\NotificationRights;
use App\Rights\ArticleRights;
use App\Rights\DashboardRights;
use App\Rights\MyAccountRights;
use App\Rights\ProfileRights;
use Illuminate\Support\Facades\Route;

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
Auth::routes(['register' => false]);

Route::get('/', [IndexController::class,'show'])->name('home');

//dashboard
Route::group(['middleware'=>['check_user_role:' . DashboardRights::getRouteAccess()]],function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
});

//Mon compte
Route::group(['middleware'=>['check_user_role:' . MyAccountRights::getRouteAccess()]],function () {
    Route::get('/my-account/{user}', [ProfileController::class,'edit'])->name('myProfile.my-account');
});


// Users
Route::group(['middleware'=>['check_user_role:' . ProfileRights::getRouteAccess()]],function () {
    Route::get('/profile/{user}/edit', [ProfileController::class,'edit'])->name('profile.edit');
    Route::get('/profile/{user}/show', [ProfileController::class,'show'])->name('profile.show');
    Route::get('/profile/list', [ProfileController::class,'index'])->name('profile.index');
    Route::get('/profile/new', [ProfileController::class,'create'])->name('profile.create');
    Route::post('/profile/store', [ProfileController::class,'store'])->name('profile.store');
    Route::get('/profile/{user}/disabled', [ProfileController::class,'disabled'])->name('profile.disabled');
    Route::get('/profile/{user}/delete', [ProfileController::class,'destroy'])->name('profile.delete');
    Route::put('/profile/{user}/update', [ProfileController::class,'update'])->name('profile.update');
});

//notifications
Route::group(['middleware'=>['check_user_role:' . NotificationRights::getRouteAccess()]],function () {
    Route::get('/notifications', [NotificationsController::class,'index'])->name('notifications.index');
    Route::get('/notifications/readall',[NotificationsController::class,'readAllNotifications'])->name('notifications.readAll');
    Route::get('/notifications/clear/{type}',[NotificationsController::class,'clear'])->name('notifications.clear');
});


//article
Route::group(['middleware'=>['check_user_role:' . ArticleRights::getRouteAccess() ]],function () {
    Route::get('/articles', [ArticleController::class,'index'])->name('article.index');
});

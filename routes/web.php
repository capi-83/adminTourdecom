<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Role\UserRole;
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

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')
    ->middleware('check_user_role:' . UserRole::ROLE_MEMBRE.',false');


Route::group(['middleware'=>['check_user_role:' . UserRole::ROLE_MEMBRE.',false']],function () {
    Route::get('/my-account/{user}', [ProfileController::class,'edit'])->name('myProfile.my-account');
});

Route::group(['middleware'=>['check_user_role:' . UserRole::ROLE_GARDIEN]],function () {
    Route::get('/profile/{user}/edit', [ProfileController::class,'edit'])->name('profile.edit');
    Route::get('/profile/{user}/show', [ProfileController::class,'show'])->name('profile.show');
    Route::put('/profile/{user}/update', [ProfileController::class,'update'])->name('profile.update');
    Route::get('/profile/list', [ProfileController::class,'index'])->name('profile.index');
    Route::get('/profile/new', [ProfileController::class,'create'])->name('profile.create');
    Route::post('/profile/store', [ProfileController::class,'store'])->name('profile.store');
    Route::get('/profile/{user}/disabled', [ProfileController::class,'disabled'])->name('profile.disabled');
    Route::get('/profile/{user}/delete', [ProfileController::class,'destroy'])->name('profile.delete');
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\PoliceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::view('/home', 'home')->middleware(['auth', 'verified']);
Route::view('/profile/edit', 'profile.edit')->middleware(['auth', 'verified'])->name('profile.edit');
Route::view('/profile/password', 'profile.password')->middleware(['auth', 'verified']);

Route::controller(PoliceController::class)->prefix('police/')->group(function () {
    Route::get('index', 'index')->name('police.index');
    Route::get('create', 'create')->name('police.create');
    Route::post('store', 'store')->name('police.store');
    Route::get('edit/{id}', 'edit')->name('police.edit');
    Route::post('update/{id}', 'update')->name('police.update');
    Route::post('delete/{id}', 'delete')->name('police.delete');
});

Route::controller(AuthController::class)->prefix('users/')->group(function () {
    Route::get('index', 'index')->name('users.index');
    Route::get('create', 'create')->name('users.create');
    Route::post('store', 'store')->name('users.store');
    Route::get('edit/{id}', 'edit')->name('users.edit');
    Route::post('update/{id}', 'update')->name('users.update');
    Route::post('delete/{id}', 'delete')->name('users.delete');
});

Route::controller(IssueController::class)->prefix('issues/')->group(function () {
    Route::get('index', 'index')->name('issues.index');
    Route::get('create', 'create')->name('issues.create');
    Route::post('store', 'store')->name('issues.store');
    Route::get('edit/{id}', 'edit')->name('issues.edit');
    Route::post('update/{id}', 'update')->name('issues.update');

    Route::post('delete/{id}', 'delete')->name('issues.delete');

});


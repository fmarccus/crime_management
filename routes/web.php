<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplainantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\PersonController;
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

Route::view('/home', 'home')->middleware(['auth']);
Route::view('/profile/edit', 'profile.edit')->middleware(['auth'])->name('profile.edit');
Route::view('/profile/password', 'profile.password')->middleware(['auth']);


Route::controller(AuthController::class)->prefix('users/')->group(function () {
    Route::get('index', 'index')->name('users.index');
    Route::get('police', 'police')->name('police.index');
    Route::get('investigators', 'investigators')->name('investigators.index');
    Route::get('complainants', 'complainants')->name('complainants.index');
    Route::get('create', 'create')->name('users.create');
    Route::post('store', 'store')->name('users.store');
    Route::get('edit/{id}', 'edit')->name('users.edit');
    Route::post('update/{id}', 'update')->name('users.update');
    Route::post('delete/{id}', 'delete')->name('users.delete');
});

Route::controller(PersonController::class)->group(function () {
    Route::get('witnesses/index', 'getWitnesses')->name('witnesses.index')->middleware('admin');
    Route::get('suspects/index', 'getSuspects')->name('suspects.index')->middleware('admin');
    Route::get('person/view/{id}', 'view')->name('person.view')->middleware('admin');
});


Route::controller(IssueController::class)->prefix('issues/')->group(function () {
    Route::get('index', 'index')->name('issues.index');
    Route::get('view/{id}', 'view')->name('issues.view');
    Route::get('create', 'create')->name('issues.create');
    Route::post('store', 'store')->name('issues.store');
    Route::post('storeEvidence/{id}', 'storeEvidence')->name('store.evidence');

    Route::get('edit/{id}', 'edit')->name('issues.edit')->middleware('admin');
    Route::post('update/{id}', 'update')->name('issues.update')->middleware('admin');
    Route::post('delete/{id}', 'delete')->name('issues.delete')->middleware('admin');
    Route::post('progress/store/{id}', 'storeProgress')->name('progress.store');
    Route::post('person/store/{id}', 'storePerson')->name('person.store');
});

Route::post('/get-barangay-crime-data', 'DashboardController@getBarangayCrimeData')->name('getBarangayCrimeData');
Route::post('/get-barangay-crime-data', [DashboardController::class, 'getBarangayCrimeData'])->name('getBarangayCrimeData');

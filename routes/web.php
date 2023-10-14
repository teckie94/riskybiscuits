<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CafeController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);

// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);


// Users 
Route::middleware('auth')->prefix('users')->name('users.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('destroy');
    Route::get('/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');

    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [UserController::class, 'export'])->name('export');
});

//Customer records
Route::middleware('auth')->prefix('cafes')->name('cafes.')->group(function(){
    Route::get('/view-cafe', [CafeController::class, 'viewcafe'])->name('viewcafe');
    Route::get('/create-cafe', [CafeController::class, 'createcafe'])->name('createcafe');
    Route::post('/store-cafe', [CafeController::class, 'storecafe'])->name('storecafe');
    Route::get('/editcafe/{cafe}', [CafeController::class, 'editcafe'])->name('editcafe');
    Route::put('/updatecafe/{cafe}', [CafeController::class, 'updatecafe'])->name('updatecafe');
    Route::delete('/deleterecord/{cafe}', [CafeController::class, 'destroy'])->name('destroycafe')->withTrashed();
    Route::get('/archivecafe', [CafeController::class, 'archive'])->name('archive');
    Route::get('/recovercafe', [App\Http\Controllers\CafeController::class, 'restore'])->where('id','[0-9]+')->name('restore');
    Route::get('/import-cafes', [CafeController::class, 'importCafes'])->name('import');
    Route::post('/upload-cafes', [CafeController::class, 'uploadcafes'])->name('upload');
    Route::get('export-cafes/', [CafeController::class, 'exportCafes'])->name('export');
});





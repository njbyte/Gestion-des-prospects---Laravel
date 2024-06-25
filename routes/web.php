<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Auth::routes();
Route::middleware('auth')->group(function () {
Route::get('/', function () {
    return view('auth.login');
});});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::view('admin', 'admin.ViewUsers')->name('dashboard');


    });
});
Route::middleware('auth')->group(function () {
    Route::get('/admin/ViewUsers', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/ViewUsers/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/ViewUsers/store', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/ViewUsers/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/ViewUsers/{user}/update', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/ViewUsers/{user}/delete', [AdminController::class, 'destroy'])->name('admin.users.destroy');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

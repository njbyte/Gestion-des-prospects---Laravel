<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QualificateurController;



    Route::get('/', function () {
        return view('auth.login');
    });



    Route::get('/dashboard', [AdminController::class, 'logout'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::view('admin', 'admin.ViewUsers')->name('dashboard');


    });
});
Route::middleware('auth','verified')->group(function () {
    Route::get('/admin/ViewUsers', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/ViewUsers/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/ViewUsers/store', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/ViewUsers/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/ViewUsers/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/ViewUsers/{user}/delete', [AdminController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/admin/ViewProspects', [AdminController::class, 'viewprospects'])->name('admin.prospects');
    Route::get('/admin/ViewProspects/create', [AdminController::class, 'createPros'])->name('admin.prospect.create');
    Route::post('/admin/ViewProspects/store', [AdminController::class, 'storePros'])->name('admin.prospect.store');
    Route::get('/admin/ViewProspects/{prospect}/edit', [AdminController::class, 'editPros'])->name('admin.prospect.edit');
    Route::put('/admin/ViewProspects/{prospect}', [AdminController::class, 'updatePros'])->name('admin.prospect.update');
    Route::delete('/admin/ViewProspects/{prospect}/delete', [AdminController::class, 'destroyPros'])->name('admin.prospect.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/Qualificateur/ViewProspects', [QualificateurController::class, 'viewprospects'])->name('qualif.prospects');
    Route::get('/Qualificateur/ViewProspects/create', [QualificateurController::class, 'createPros'])->name('qualif.prospect.create');
    Route::post('/Qualificateur/ViewProspects/store', [QualificateurController::class, 'storePros'])->name('qualif.prospect.store');
    Route::get('/Qualificateur/ViewProspects/{prospect}/edit', [QualificateurController::class, 'editPros'])->name('qualif.prospect.edit');
    Route::put('/Qualificateur/ViewProspects/{prospect}', [QualificateurController::class, 'updatePros'])->name('qualif.prospect.update');
});
Route::middleware('auth')->group(function () {
    Route::get('/Qualificateur/ViewProspects', [QualificateurController::class, 'viewprospects'])->name('comm.prospects');
    Route::get('/Qualificateur/ViewProspects/create', [QualificateurController::class, 'createPros'])->name('comm.prospect.create');
    Route::post('/Qualificateur/ViewProspects/store', [QualificateurController::class, 'storePros'])->name('comm.prospect.store');
    Route::get('/Qualificateur/ViewProspects/{prospect}/edit', [QualificateurController::class, 'editPros'])->name('comm.prospect.edit');
    Route::put('/Qualificateur/ViewProspects/{prospect}', [QualificateurController::class, 'updatePros'])->name('comm.prospect.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

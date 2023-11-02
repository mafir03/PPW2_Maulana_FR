<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard',[BukuController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/dashboard/store', [BukuController::class, 'store'])->name('buku.store');
        Route::post('/dashboard/destroy/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
        Route::get('/dashboard/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
        Route::post('/dashboard/update/{id}', [BukuController::class, 'update'])->name('buku.update');
    });
    Route::get('/dashboard/search', [BukuController::class, 'search'])->name('buku.search');

});

require __DIR__.'/auth.php';

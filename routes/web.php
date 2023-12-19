<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\GalleryController;
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

Route::get('/public/dashboard', [BukuController::class, 'publicIndex'])->name('public.dashboard');
Route::get('/public/galeri-buku/{id}', [BukuController::class, 'publicGaleriBuku'])->name('public.galeri-buku');


Route::get('/dashboard',[BukuController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/dashboard/store', [BukuController::class, 'store'])->name('buku.store');
        Route::post('/dashboard/destroy/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
        Route::get('/dashboard/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
        Route::post('/dashboard/update/{id}', [BukuController::class, 'update'])->name('buku.update');
        Route::post('/dashboard/destroy/gallery/{id}',[GalleryController::class, 'destroy'])->name("gallery.destroy");
    });
    Route::get('/dashboard/search', [BukuController::class, 'search'])->name('buku.search');
    Route::get('/galeri-buku/{id}',[BukuController::class, 'galeriBuku'])->name('galeri-buku');

    Route::post('/galeri-buku/rating/{bukuId}',[BukuController::class, 'setRating'])->name('setrating');

    Route::get("/galeri-buku/rating/{bukuId}",[BukuController::class, 'getRating'])->name('getRating');

    Route::get('/buku-populer',[BukuController::class, 'bukuPopuler'])->name('buku.populer');

    Route::post('/galeri-buku/favorite',[BukuController::class, 'setFavorite'])->name('setFavorite');

    Route::get('/buku/kategori',[BukuController::class, 'bukuKategori'])->name('buku.kategori');
    Route::get('/buku/kategori/search',[BukuController::class, 'kategoriSearch'])->name('buku.kategoriSearch');


    Route::get('/buku/favorite', [BukuController::class, 'favorite'])->name('buku.favorite');
    
});

require __DIR__.'/auth.php';

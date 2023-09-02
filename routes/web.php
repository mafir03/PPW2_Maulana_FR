<?php

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

Route::get('/home', function () {
    return view('home');
});

Route::get('/action', function () {
    return view('action');
});

Route::get('/resources', function () {
    return view('resources');
});

Route::get('/projects', function () {
    return view('projects');
});

Route::get('/explore', function () {
    return view('explore');
});


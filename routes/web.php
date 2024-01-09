<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MiembroController;

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

Route::get('/', function () {return view('index');})->middleware('auth');

Auth::routes(['register'=>false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/miembros', MiembroController::class);

// Route::get('/miembros', [MiembroController::class, 'index']);
// Route::post('/miembros/create', [MiembroController::class, 'create']);

// Route::get('/miembros/create', function () {return view('miembros.create');})->middleware('auth');
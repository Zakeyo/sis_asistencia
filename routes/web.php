<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AsistenciaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MiembroController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {return view('index');})->middleware('auth');
Route::get('/', [AdminController::class, 'index'])->middleware('auth');

Auth::routes(['register'=>false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/miembros', MiembroController::class);
Route::resource('/cargos', CargoController::class);
Route::resource('/usuarios', UserController::class);
Route::resource('/asistencias', AsistenciaController::class);

<?php

use App\Http\Controllers\RegistroController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MayorController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ComprobacionController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\RegistroCostoController;
use App\Http\Controllers\ListaCostosController;
use App\Http\Controllers\ResultadosController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;


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
    return view('welcome');
});


Route::resource('Registro', RegistroController::class);
Route::resource('mayor', MayorController::class);
Route::resource('Welcome', WelcomeController::class);
Route::resource('Comprobacion', ComprobacionController::class);
Route::resource('Costos', RegistroCostoController::class);

Route::resource('Usuario', UsuarioController::class);
Route::resource('Resultados', ResultadosController::class);
Route::resource('General', GeneralController::class);

Route::delete('LCostos/{id}', [ListaCostosController::class, 'delete'])->name('LCostos.delete');

Route::get('login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'loguear'])->name('login.loguear');
Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');


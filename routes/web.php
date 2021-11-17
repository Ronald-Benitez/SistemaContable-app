<?php

use App\Http\Controllers\RegistroController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MayorController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ComprobacionController;

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

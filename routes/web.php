<?php

use Illuminate\Support\Facades\Route;

//importe adcionado para chamar controle user
use App\Http\Controllers\UserAuthControler;

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

//Rota login
Route::get('/', [UserAuthControler::class, 'login'])->middleware('AlreadyLoggedIn');
Route::get('register', [UserAuthControler::class, 'register'])->middleware('AlreadyLoggedIn');
Route::post('create', [UserAuthControler::class, 'create'])->name('auth.create');
Route::post('check', [UserAuthControler::class, 'check'])->name('auth.check');
Route::get('profile', [UserAuthControler::class, 'profile'])->middleware('isLogged'); //middleware para proteger pagina e rota profile em caso de copiar url perfil 
Route::get('logout', [UserAuthControler::class, 'logout']);

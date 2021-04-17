<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('salvarUsuario', [UsuarioController::class, 'salvar']);
Route::post('lsUsuarioPorFiltro', [UsuarioController::class, 'lsUsuarioPorFiltro']);
Route::post('excluirUsuario', [UsuarioController::class, 'excluirUsuario']);
Route::post('logar', [LoginController::class, 'logar']);
Route::get('verficarLogado', [LoginController::class, 'verficarLogado']);

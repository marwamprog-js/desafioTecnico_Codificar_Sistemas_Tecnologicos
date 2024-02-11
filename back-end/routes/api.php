<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('v1')->middleware('jwt.auth')->group(function() {
    Route::get('me', 'App\Http\Controllers\AuthController@me');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::get('logout', 'App\Http\Controllers\AuthController@logout');

    Route::apiResource('/posts', 'App\Http\Controllers\PostController');
    Route::get('/posts/{id}/user', 'App\Http\Controllers\PostController@showPorIdLogado');
    Route::get('/posts/{id}/qtd-posts', 'App\Http\Controllers\PostController@qtdPosts');

    Route::patch('/users/altera-nome', 'App\Http\Controllers\UserController@alterarNome');
    Route::patch('/users/altera-senha', 'App\Http\Controllers\UserController@alterarSenha');

});

Route::prefix('v1')->group(function() {
    //## Cadastro Usuarios
    Route::post('users', 'App\Http\Controllers\UserController@store');
    
    //## Login
    Route::post('login', 'App\Http\Controllers\AuthController@login');
});

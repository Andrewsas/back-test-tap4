<?php

use Illuminate\Http\Request;

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

/* Rotas de CRUD de professores */

Route::get('/language', ['as' => 'language.listar', 'uses' => 'LaguageController@index']);

Route::get('/language/{id}', ['as' => 'language.detalhes', 'uses' => 'LaguageController@show']);

Route::post('/language', ['as' => 'language.salvar', 'uses' => 'LaguageController@store']);

Route::put('/language/{id}', ['as' => 'language.editar', 'uses' => 'LaguageController@update']);

Route::delete('/language/{id}', ['as' => 'language.deletar', 'uses' => 'LaguageController@destroy']);


Route::get('/', function () {
    return 'welcome';
});

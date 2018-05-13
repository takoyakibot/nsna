<?php

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

Route::get('/', 'CharacterController@index');

Route::get('/actor', 'CharacterController@show');
Route::get('/actor/{id_rand}', 'CharacterController@show');
Route::post('/actor/{id_rand}', 'CharacterController@submit');
Route::get('/actor/{id_rand}/text', 'CharacterController@textshow');

//Route::get('characters', function () { return view('characters'); });

Auth::routes();


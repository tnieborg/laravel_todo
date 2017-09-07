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

Route::get('/', 'Todo_controller@index');
Route::get('/ajax', 'Todo_controller@ajax');
Route::post('/', 'Todo_controller@create');
Route::post('/{id}', 'Todo_controller@update');
Route::post('/{id}/priority', 'Todo_controller@priority');
Route::delete('/{id}', 'Todo_controller@delete');


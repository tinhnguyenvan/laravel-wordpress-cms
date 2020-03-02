<?php

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "console" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/users/activemail', 'UserController@activeMail');

Route::get('/', 'LoginController@index');
Route::get('/login', 'LoginController@index');
Route::post('/auth', 'LoginController@auth');

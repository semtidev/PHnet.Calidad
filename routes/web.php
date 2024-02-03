<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

// Start App
Route::get('/', 'AppController@index')->name('Home');
Route::get('/home', 'AppController@index')->name('Home');
Route::get('/locked', 'AppController@locked')->name('Locked Screen');
<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/su/{code}', 'IndexController@index')->name('index.index');
Route::get('/administration', 'IndexController@addUrlForm')->name('index.addForm');
Route::get('/submit', 'IndexController@addUrl')->name('index.add');


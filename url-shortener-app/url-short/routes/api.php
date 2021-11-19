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


Route::group(['prefix' => '/'], function() {
    Route::post('url.json', 'Api\UrlController@url');
    Route::get('top.json', 'Api\UrlController@top');
    Route::get('{code}', 'Api\UrlController@getCode');
});

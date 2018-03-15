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


Route::prefix('user')->group(function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('user')->group(function () {
        Route::any('/', function (Request $request) {
            return ['data' => $request->user()];
        });
        Route::post('logout', 'Auth\LoginController@logout');
        Route::prefix('update')->group(function () {
            Route::post('login', 'UserController@updateLogin');
            Route::post('password', 'UserController@updatePassword');
        });
    });

    Route::resource('software', 'SoftwareController', ['only' => [
        'index', 'show'
    ]]);

    Route::resource('configuration', 'ConfigurationController', ['only' => [
        'index', 'show', 'store', 'update', 'destroy'
    ]]);
});


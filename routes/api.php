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

Route::group(['prefix' => 'auth', 'namespace' => 'Api'], function () {

    Route::post('register', 'AuthController@register');
    Route::post('login',    'AuthController@login');

    Route::group(['middleware' => 'auth.jwt'], function () {
        Route::get('logout',    'AuthController@logout');
        Route::get('refresh',   'AuthController@refreshToken');
        Route::get('user',      'AuthController@getUser');

    });

    Route::any('{segment}', function () {
        return response()->json([
            'error' => 'Invalid url or Method'
        ], 400);
    })->where('segment', '.*');
});
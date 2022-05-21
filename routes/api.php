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

/*
    Auth Routes
*/

Route::group(['prefix' => 'auth', 'namespace' => 'Api'], function () {

    // Register Route
    Route::post('register', 'AuthController@register');

    // Login Route
    Route::post('login',    'AuthController@login');


    Route::any('{segment}', function () {
        return response()->json([
            'error' => 'Invalid url or Method'
        ], 400);
    })->where('segment', '.*');
});


/*
    Page Routes
*/

Route::group(['prefix' => 'page', 'namespace' => 'Api'], function () {

    Route::group(['middleware' => 'auth.jwt'], function () {

        //Page Create Route
        Route::post('create',    'PageController@createPage');

        //Post Create From Page 
        Route::post('{pageId}/attach-post',    'PostController@createPostByPage');
    });
});

/*
    Person Routes
*/

Route::group(['prefix' => 'person', 'namespace' => 'Api'], function () {

    Route::group(['middleware' => 'auth.jwt'], function () {
        // Post Create by User
        Route::post('attach-post',    'PostController@createPostByUser');
    });
});


/*
    Follow Routes
*/
Route::group(['prefix' => 'follow', 'namespace' => 'Api'], function () {

    Route::group(['middleware' => 'auth.jwt'], function () {
        //  Follow a Person 
        Route::post('person/{personId}',    'FollowController@followPerson');

        // Follow a page
        Route::post('page/{pageId}',    'FollowController@followPage');
    });
});
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([

    'middleware' => 'api',
//    'prefix' => 'auth'

], function ($router) {
    Route::post('auth/login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('request/send', 'FriendshipController@sendRequest');
    Route::post('request/canceled', 'FriendshipController@canceledRequest');
    Route::post('request/accepted', 'FriendshipController@acceptedRequest');
    Route::post('request/rejected', 'FriendshipController@rejectRequest');
    Route::post('register', 'AuthController@register');

});

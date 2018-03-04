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

Route::post('login','AuthController@login');
Route::post('register','AuthController@register');

Route::get('user-info','AuthController@UserInfo');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});

Route::apiResource('products','ProductController');

Route::group(['prefix' => 'products'], function  (){
    Route::apiResource('{product}/reviews','ReviewController');
});

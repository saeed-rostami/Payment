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

//Route::middleware('auth:api')->get('/product', function (Request $request) {
//    return $request->user();
//});

Route::prefix('product')->group(function() {
    Route::get('/', 'ProductController@index');
    Route::get('/{product}', 'ProductController@show');

//    ADMIN
    Route::prefix('admin')->middleware('auth:api')->group(function() {
        Route::get('/', 'AdminProductController@index');
        Route::get('/{product}', 'AdminProductController@show');
        Route::post('/store', 'AdminProductController@store');
        Route::put('/update/{product}', 'AdminProductController@update');
        Route::delete('/destroy/{product}', 'AdminProductController@destroy');
    });
});

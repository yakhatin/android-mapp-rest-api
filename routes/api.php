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

Route::prefix('/catalogs')->group(function () {
    Route::get('/', 'CatalogController@get');
    Route::post('/', 'CatalogController@create');
    Route::delete('/{id}', 'CatalogController@delete');
    Route::put('/{id}', 'CatalogController@update');
});

Route::prefix('/articles')->group(function () {
    Route::get('/', 'ArticleController@get');
    Route::post('/', 'ArticleController@create');
    Route::delete('/{id}', 'ArticleController@delete');
    Route::put('/{id}', 'ArticleController@update');
});

Route::prefix('/commentaries')->group(function () {
    Route::get('/', 'CommentaryController@get');
    Route::post('/', 'CommentaryController@create');
    Route::delete('/{id}', 'CommentaryController@delete');
    Route::put('/{id}', 'CommentaryController@update');
});
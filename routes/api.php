<?php

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

/**
 * Авторизация/Регистрация пользователей
 */
Route::get('/login', 'UserController@auth');
Route::post('/register', 'UserController@register');

/**
 * Роуты без авторизации
 */
Route::get('/catalogs', 'CatalogController@get');
Route::get('/articles', 'ArticleController@get');
Route::get('/commentaries', 'CommentaryController@get');

/**
 * Роуты требующие токена-авторизации
 */
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/catalogs')->group(function () {
        Route::post('/', 'CatalogController@create');
        Route::delete('/{id}', 'CatalogController@delete');
        Route::put('/{id}', 'CatalogController@update');
    });

    Route::prefix('/articles')->group(function () {
        Route::post('/', 'ArticleController@create');
        Route::delete('/{id}', 'ArticleController@delete');
        Route::put('/{id}', 'ArticleController@update');
    });

    Route::prefix('/commentaries')->group(function () {
        Route::post('/', 'CommentaryController@create');
        Route::delete('/{id}', 'CommentaryController@delete');
        Route::put('/{id}', 'CommentaryController@update');
    });
});
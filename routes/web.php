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

Route::prefix('/catalogs')->group(function () {
    Route::get('/list', function () {
        return view('catalogs.list');
    });
    Route::get('/form', function () {
        return view('catalogs.form');
    });
    Route::get('/form/{id}', function () {
        return view('catalogs.form');
    });
    Route::get('/create', 'CatalogController@createFromWeb');
    Route::get('/edit/{id}', 'CatalogController@editFromWeb');
    Route::get('/delete/{id}', 'CatalogController@deleteFromWeb');
});

Route::prefix('/articles')->group(function () {
    Route::get('/list', function () {
        return view('articles.list');
    });
    Route::get('/form', function () {
        return view('articles.form');
    });
    Route::get('/form/{id}', function () {
        return view('articles.form');
    });
    Route::get('/create', 'ArticleController@createFromWeb');
    Route::get('/edit/{id}', 'ArticleController@editFromWeb');
    Route::get('/delete/{id}', 'ArticleController@deleteFromWeb');
});
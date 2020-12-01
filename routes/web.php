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
    Route::get('/add', function () {
        return view('catalogs.create');
    });
    Route::get('/create', 'CatalogController@createFromWeb');
});

Route::prefix('/articles')->group(function () {
    Route::get('/list', function () {
        return view('articles.list');
    });
    Route::get('/add', function () {
        return view('articles.create');
    });
    Route::get('/create', 'ArticleController@createFromWeb');
});
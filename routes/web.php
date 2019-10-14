<?php

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

use Artisanry\Commentable\Models\Comment;

Auth::routes();

Route::post('/login', 'Auth\LoginController@login')->name('login.submit');

Route::get('/', 'Web\HomeController@index')->name('home');

Route::post('/search', 'Web\SearchController@search')->name('search');

Route::get('/favorites', 'FavoritesController@index')->name('favorites.index');

Route::post('/favorites', 'FavoritesController@toggle')->name('favorites.toggle');

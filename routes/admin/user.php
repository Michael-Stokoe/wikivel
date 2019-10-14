<?php

Route::group(
    [
        'as' => 'user.',
        'prefix' => 'user'
    ],
    function () {
        Route::get('/', 'UserController@index')->name('index');

        Route::get('/create', 'UserController@create')->name('create');
        Route::post('/create', 'UserController@store')->name('store');

        Route::get('/{id}', 'UserController@show')->name('show');

        Route::get('/{id}/edit', 'UserController@edit')->name('edit');
        Route::put('/{id}/edit', 'UserController@update')->name('update');

        Route::post('/{id}/delete', 'UserController@delete')->name('delete');
    }
);

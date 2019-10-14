<?php

Route::group(
    [
        'as' => 'image.',
        'prefix' => 'image'
    ],
    function () {
        Route::get('/', 'ImageController@index')->name('index');

        Route::get('/create', 'ImageController@create')->name('create');
        Route::post('/create', 'ImageController@store')->name('store');

        Route::get('/{id}', 'ImageController@show')->name('show');

        Route::get('/{id}/edit', 'ImageController@edit')->name('edit');
        Route::put('/{id}/edit', 'ImageController@update')->name('update');

        Route::post('/{id}/delete', 'ImageController@delete')->name('delete');
    }
);

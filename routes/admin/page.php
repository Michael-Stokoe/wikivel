<?php

Route::group(
    [
        'as' => 'page.',
        'prefix' => 'page'
    ],
    function () {
        Route::get('/', 'PageController@index')->name('index');

        Route::get('/create', 'PageController@create')->name('create');
        Route::post('/create', 'PageController@store')->name('store');

        Route::get('/{id}', 'PageController@show')->name('show');

        Route::get('/{id}/edit', 'PageController@edit')->name('edit');
        Route::put('/{id}/edit', 'PageController@update')->name('update');

        Route::post('/{id}/delete', 'PageController@delete')->name('delete');
    }
);

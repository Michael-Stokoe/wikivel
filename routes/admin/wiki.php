<?php

Route::group(
    [
        'as' => 'wiki.',
        'prefix' => 'wiki'
    ],
    function () {
        Route::get('/', 'WikiController@index')->name('index');

        Route::get('/create', 'WikiController@create')->name('create');
        Route::post('/create', 'WikiController@store')->name('store');

        Route::get('/{id}', 'WikiController@show')->name('show');

        Route::get('/{id}/edit', 'WikiController@edit')->name('edit');
        Route::put('/{id}/edit', 'WikiController@update')->name('update');

        Route::post('/{id}/delete', 'WikiController@delete')->name('delete');
    }
);

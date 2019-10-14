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

        Route::get('/{wiki}', 'WikiController@show')->name('show');

        Route::get('/{wiki}/edit', 'WikiController@edit')->name('edit');
        Route::put('/{wiki}/edit', 'WikiController@update')->name('update');

        Route::post('/{wiki}/delete', 'WikiController@delete')->name('delete');
    }
);

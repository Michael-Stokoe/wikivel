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

        Route::get('/{page}', 'PageController@show')->name('show');

        Route::get('/{page}/edit', 'PageController@edit')->name('edit');
        Route::put('/{page}/edit', 'PageController@update')->name('update');

        Route::post('/{page}/delete', 'PageController@delete')->name('delete');
    }
);

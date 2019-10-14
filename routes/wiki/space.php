<?php

Route::group(
    [
        'as' => 'space.',
        'prefix' => 'space'
    ],
    function () {
        Route::get('/', 'SpaceController@index')->name('index');

        Route::get('/create', 'SpaceController@create')->name('create');
        Route::post('/create', 'SpaceController@store')->name('store');

        Route::get('/{space}', 'SpaceController@show')->name('show');

        Route::get('/{space}/edit', 'SpaceController@edit')->name('edit');
        Route::put('/{space}/edit', 'SpaceController@update')->name('update');

        Route::post('/{space}/delete', 'SpaceController@delete')->name('delete');
    }
);

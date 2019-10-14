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

        Route::get('/{id}', 'SpaceController@show')->name('show');

        Route::get('/{id}/edit', 'SpaceController@edit')->name('edit');
        Route::put('/{id}/edit', 'SpaceController@update')->name('update');

        Route::post('/{id}/delete', 'SpaceController@delete')->name('delete');
    }
);

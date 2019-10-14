<?php

Route::group(
    [
        'as' => 'user.',
        'prefix' => 'user'
    ],
    function () {
        Route::get('/{id}', 'UserController@show')->name('show');
        Route::get('/{id}/edit', 'UserController@edit')->name('edit');
        Route::put('/{id}/edit', 'UserController@update')->name('update');
    }
);

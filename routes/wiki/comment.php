<?php

Route::group(
    [
        'prefix' => 'comment',
        'as' => 'comment.',
    ],
    function () {
        Route::post('/store', 'CommentController@store')->name('store');

        Route::post('/{id}/delete', 'CommentController@deleteComment')->name('delete');

        Route::get('/{id}/report', 'CommentController@reportComment')->name('report');
        Route::post('/{id}/report', 'CommentController@storeReportComment')->name('report.store');

        Route::get('/reply/{id}', 'CommentController@replyToComment')->name('reply');

        Route::get('/show/{id}', 'CommentController@showComment')->name('show');
    }
);

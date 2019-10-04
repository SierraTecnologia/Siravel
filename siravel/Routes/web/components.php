<?php


Route::namespace('Components')->group(function () {
    Route::get('/playground/{route?}', 'LogicController@index');

    Route::get('/board', 'BoardController@index');
    Route::get('/board/show', 'BoardController@show');
});
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
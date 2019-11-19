<?php

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::group(['namespace' => 'Feature'], function () {
    Route::group(['namespace' => 'Manipule'], function () {
        Route::resource('actions', 'ActionController');
        Route::get('actions/model/{model}', 'ActionController@actionsForModel')->name('actions.model');
        Route::get('actions/execute/{modelId}/{actionCod}', 'ActionController@executeAction')->name('actions.execute');
    });
});
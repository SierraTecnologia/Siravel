<?php

Route::group(['namespace' => 'Features'], function () {
    Route::group(['namespace' => 'Manipule'], function () {
        Route::resource('actions', 'ActionController');
        Route::get('actions/model/{model}', 'ActionController@actionsForModel')->name('actions.model');
        Route::get('actions/execute/{modelId}/{actionCod}', 'ActionController@executeAction')->name('actions.execute');
    });
});
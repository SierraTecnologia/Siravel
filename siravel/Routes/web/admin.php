<?php

Route::prefix('Admin')->group(function () {
    Route::namespace('Admin')->group(function () {
        Route::get('/', 'HomeController@index');
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('users', 'UserController');

        Route::resource('languages', 'LanguageController');
        Route::resource('sectors', 'SectorController');
        Route::resource('services', 'ServiceController');
        Route::resource('ambientes', 'AmbienteController');

        Route::resource('actions', 'ActionController');
        Route::get('actions/model/{model}', 'ActionController@actionsForModel')->name('actions.model');
        Route::get('actions/execute/{modelId}/{actionCod}', 'ActionController@executeAction')->name('actions.execute');
        
        Route::resource('databases', 'DatabaseController');
        Route::resource('databaseCollections', 'DatabaseCollectionsController');
        Route::resource('projects', 'ProjectController');
        Route::resource('collaborators', 'CollaboratorController');
        Route::resource('runners', 'RunnerController');
        Route::resource('loggers', 'LoggerController');
        Route::resource('computers', 'ComputerController');
        Route::resource('domains', 'DomainController');
        Route::resource('settings', 'SettingController');
    });
});
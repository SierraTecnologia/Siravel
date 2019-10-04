<?php

//Route::group(['middleware' => ['siravel-analytics']], function () {                                                                                                                           
    $alias = 'public.';
    
    Route::get('/',         ['as' => $alias . 'home',   'uses' => 'PagesController@getHome']);
    Route::get('contato', array('as' => $alias . 'contact', 'uses' =>'PagesController@contact'));
    Route::post('/contact', ['as' => $alias . 'contact',   'uses' => 'PagesController@postContact']);

    Auth::routes();

    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "admin.php";
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "components.php";
    // include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "wiki.php";
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "book.php";                                                                              
//});    
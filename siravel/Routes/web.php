<?php

Route::group(
    ['middleware' => ['web']], function () {  
        // Route::group(['middleware' => ['siravel-analytics']], function () {
        Route::name('siravel.')->group(
            function () {
                Route::group(
                    ['prefix' => 'siravel'], function () {
                        include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "recursos.php";
                        include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "features.php";

                        // include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "wiki.php";
                        // include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "book.php";
                    }
                );
            }
        );
    }
);
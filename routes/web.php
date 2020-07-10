<?php

Route::group(
    ['middleware' => ['web']], function () {  
        // Route::group(['middleware' => ['siravel-analytics']], function () {
        Route::name('siravel.')->group(
            function () {
                Route::group(
                    ['prefix' => 'siravel'], function () {


                        $loadingRoutes = [
                            'public',
                            'admin',
                            'features',
                            'recursos'
                        ];
                        foreach ($loadingRoutes as $loadingRoute) {
                            include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . $loadingRoute.".php";
                        }

                        // include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "wiki.php";
                        // include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "book.php";
                    }
                );
            }
        );
    }
);
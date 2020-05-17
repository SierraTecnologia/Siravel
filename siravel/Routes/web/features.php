<?php

Route::group(
    ['namespace' => 'Features'], function () {
        Route::group(
            ['namespace' => 'Manipule'], function () {


                Route::get('/creator', 'CreatorController@download')->name('creator');
                Route::get('/excel', 'ExcelController@download')->name('excell');

        
            }
        );
    }
);
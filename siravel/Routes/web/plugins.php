<?php

Route::prefix('features')->group(function () {
    Route::namespace('Features')->group(function () {
        Route::namespace('Manipule')->group(function () {
            Route::get('download', ExcelController::class . '@download');
        });
    });
});
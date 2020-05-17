<?php
Route::group(
    ['middleware' => 'auth'], function () {
        Route::group(
            ['as' => 'sitec.'], function () {
                Route::group(
                    ['namespace' => 'Pages'], function () {
                        Route::get('/sitec/dash', 'DashController@index')->name('dash');

                        Route::get('/sitec/profile', 'ProfileController@index')->name('profile');

                    }
                );
            }
        );




        Route::group(
            ['namespace' => 'Components'], function () {
                Route::group(
                    ['as' => 'components.'], function () {
                        Route::group(
                            ['namespace' => 'Actors'], function () {
                                Route::group(
                                    ['prefix' => 'actors'], function () {
                                        Route::group(
                                            ['as' => 'actors.'], function () {
                                                Route::get('/', 'ProfileController@index')->name('profile');
                                                Route::get('/show', 'ProfileController@show')->name('profile.show');
                        
                                                Route::get('/notifications/unread', 'NotificationsController@unread')->name('notifications.unread');
                                                Route::get('/notifications', 'NotificationsController@index')->name('notifications.index');
                                                Route::get('/notifications/count', 'NotificationsController@count')->name('notifications.count');

                                                Route::get('/messages', 'MessagesController@index')->name('messages.index');
                                                Route::get('/messages/to/{id}', 'MessagesController@create')->name('messages.create');
                                                Route::post('/messages', 'MessagesController@store')->name('messages.store');
                                                Route::get('/messages/{id}', 'MessagesController@show')->name('messages.show');
                                                Route::put('/messages/{id}', 'MessagesController@update')->name('messages.update');
                                            }
                                        );
                                    }
                                );
                            }
                        );
                    }
                );
            }
        );
    }
);
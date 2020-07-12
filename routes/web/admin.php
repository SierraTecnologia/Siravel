<?php

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
        Route::get('/', 'DashboardController@index');
        Route::get('/home', ['as' => 'home', 'uses' => 'DashboardController@index']);

        Route::resource('settings', 'SettingController', ['except' => ['show', 'create', 'store', 'edit']]);
        Route::get('settings/configure/{slugSetting}', 'SettingController@configure')->name('settings.configure');
        Route::post('settings/store/{slugSetting}', 'SettingController@store')->name('settings.store');

        /**
         * Apoio Operacional
         */
        Route::get('help', 'PageController@help');
        Route::get('changelog', 'PageController@changelog');

        Route::get('siravel'.'/hero-images/delete/{entity}/{entity_id}', 'SitecFeatureController@deleteHero');
        /*
        |--------------------------------------------------------------------------
        | Common Features
        |--------------------------------------------------------------------------
        */

        Route::get('preview/{entity}/{entityId}', 'SitecFeatureController@preview');
        Route::get('rollback/{entity}/{entityId}', 'SitecFeatureController@rollback');
        Route::get('revert/{id}', 'SitecFeatureController@revert');


        /**
         * Blog
         */
        Route::group(['namespace' => 'Blog'], function () {

            /*
            |--------------------------------------------------------------------------
            | Blog
            |--------------------------------------------------------------------------
            */
    
            Route::resource('blog', 'BlogController', ['except' => ['show']]);
            Route::post('blog/search', 'BlogController@search');
            Route::get('blog/{id}/history', 'BlogController@history');
    
        });


        /**
         * Calendar
         */
        Route::group(['namespace' => 'Calendar'], function () {
            /*
            |--------------------------------------------------------------------------
            | Events
            |--------------------------------------------------------------------------
            */
    
            Route::resource('events', 'EventController', ['except' => ['show']]);
            Route::post('events/search', 'EventController@search');
            Route::get('events/{id}/history', 'EventController@history');
    
        });


        /**
         * Interaction
         */
        Route::group(['namespace' => 'Interaction'], function () {


            /*
            |--------------------------------------------------------------------------
            | Contacts
            |--------------------------------------------------------------------------
            */

            Route::resource('contacts', 'ContactController', ['except' => ['show']]);
            Route::post('contacts/search', 'ContactController@search');
            Route::get('contacts/{id}/history', 'ContactController@history');

            /*
            |--------------------------------------------------------------------------
            | Promotions
            |--------------------------------------------------------------------------
            */
    
            Route::resource('promotions', 'PromotionsController', ['except' => ['show']]);
            Route::post('promotions/search', 'PromotionsController@search');
    
        });


        /**
         * Midia
         */
        Route::group(['namespace' => 'Midia'], function () {
            /*
            |--------------------------------------------------------------------------
            | Images
            |--------------------------------------------------------------------------
            */
    
            Route::resource('images', 'ImagesController', ['except' => ['show']]);
            Route::post('images/search', 'ImagesController@search');
            Route::post('images/upload', 'ImagesController@upload');

            /*
            |--------------------------------------------------------------------------
            | Files
            |--------------------------------------------------------------------------
            */
    
            Route::get('files/remove/{id}', 'FilesController@remove');
            Route::post('files/upload', 'FilesController@upload');
            Route::post('files/search', 'FilesController@search');
    
            Route::resource('files', 'FilesController', ['except' => ['show']]);
    
        });


        /**
         * Production
         */
        Route::group(['namespace' => 'Production'], function () {
    
        });


        /**
         * Commerce
         */
        Route::group(['namespace' => 'Commerce'], function () {
            include dirname(__FILE__) . DIRECTORY_SEPARATOR . "admin". DIRECTORY_SEPARATOR . "commerce.php";
        });


        /**
         * Travel
         */
        Route::group(['namespace' => 'Travel'], function () {
    
        });


        /**
         * Writelabel
         */
        Route::group(['namespace' => 'Writelabel'], function () {

            /*
            |--------------------------------------------------------------------------
            | Members
            |--------------------------------------------------------------------------
            */
    
            Route::resource('members', 'MemberController', ['only' => ['index', 'show']]);


            /*
            |--------------------------------------------------------------------------
            | Faqs
            |--------------------------------------------------------------------------
            */
    
            Route::resource('faqs', 'FaqController', ['except' => ['show']]);
            Route::post('faqs/search', 'FaqController@search');
            /*
            |--------------------------------------------------------------------------
            | Menus
            |--------------------------------------------------------------------------
            */
    
            Route::resource('menus', 'MenuController', ['except' => ['show']]);
            Route::post('menus/search', 'MenuController@search');
            Route::put('menus/{id}/order', 'MenuController@setOrder');

            /*
            |--------------------------------------------------------------------------
            | Pages
            |--------------------------------------------------------------------------
            */
    
            Route::resource('pages', 'PagesController', ['except' => ['show']]);
            Route::post('pages/search', 'PagesController@search');
            Route::get('pages/{id}/history', 'PagesController@history');

            /*
            |--------------------------------------------------------------------------
            | Links
            |--------------------------------------------------------------------------
            */
    
            Route::resource('links', 'LinksController', ['except' => ['index', 'show']]);
            Route::post('links/search', 'LinksController@search');
        });



        /*
        |--------------------------------------------------------------------------
        | Widgets
        |--------------------------------------------------------------------------
        */

        Route::resource('widgets', 'WidgetsController', ['except' => ['show']]);
        Route::post('widgets/search', 'WidgetsController@search');


        /*
        |--------------------------------------------------------------------------
        | Team Routes
        |--------------------------------------------------------------------------
        */
    
        Route::get('team/{name}', 'TeamController@showByName');
        Route::resource('teams', 'TeamController', ['except' => ['show']]);
        Route::post('teams/search', 'TeamController@search');
        Route::post('teams/{id}/invite', 'TeamController@inviteMember');
        Route::get('teams/{id}/remove/{userId}', 'TeamController@removeMember');





        // Route::resource('users', 'UserController');
        // Route::resource('girls', 'GirlController');
        // Route::resource('clients', 'ClientController');
        

        // /*
        // |--------------------------------------------------------------------------
        // | Users
        // |--------------------------------------------------------------------------
        // */
        // Route::resource('users', 'UserController', ['except' => ['create', 'show']]);
        // Route::post('users/search', 'UserController@search');
        // Route::get('users/search', 'UserController@index');
        // Route::get('users/invite', 'UserController@getInvite');
        // Route::get('users/switch/{id}', 'UserController@switchToUser');
        // Route::post('users/invite', 'UserController@postInvite');

        // /*
        // |--------------------------------------------------------------------------
        // | Roles
        // |--------------------------------------------------------------------------
        // */
        // Route::resource('roles', 'RoleController', ['except' => ['show']]);
        // Route::post('roles/search', 'RoleController@search');
        // Route::get('roles/search', 'RoleController@index');
    });
<?php

return [

    /*
     * Is email activation required
     */
    'activation' => env('ACTIVATION', false),


    /*
    |--------------------------------------------------------------------------
    | Override application config values
    |--------------------------------------------------------------------------
    |
    | If defined, settings package will override these config values.
    |
    | Sample:
    |   "app.locale" => "settings.locale",
    |
    */
    'override' => [
        "app.locale" => "settings.locale",
        "app.name" => "app_name",
        "siravel.frontend-theme" => "theme",
        "services.botman.telegram_token" => "telegram_token",
        "services.botman.facebook_token" => "facebook_token",
        "services.botman.facebook_app_secret" => "facebook_app_secret",
        "services.botman.slack_token" => "slack_token",
        "adminlte.title" => "title",
    ],

];
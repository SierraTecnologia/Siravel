<?php

if (!function_exists('commerce')) {
    function commerce()
    {
        return app(App\Services\Commerce\StoreHelperService::class);
    }
}

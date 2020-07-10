<?php

if (!function_exists('commerce')) {
    function commerce()
    {
        return app(Siravel\Services\Commerce\StoreHelperService::class);
    }
}

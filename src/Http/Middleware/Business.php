<?php

namespace Siravel\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Siravel\Services\System\BusinessService;

class Business
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $businessService = app()->make(BusinessService::class);
        if (!$businessService->hasBusiness()) {
            throw new Exception('Negocio não existe');
        }
        $businessService->loadSettings();
        return $next($request);
    }
}

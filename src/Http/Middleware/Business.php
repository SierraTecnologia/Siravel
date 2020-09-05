<?php

namespace Siravel\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Siravel\Services\System\BusinessService;
use Templeiro;

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
        // dd(Config::get('siravel.frontend-theme', 'default'));
        Templeiro::setTheme(Config::get('siravel.frontend-theme', 'default'));
        Templeiro::loadBoot();
        return $next($request);
    }
}

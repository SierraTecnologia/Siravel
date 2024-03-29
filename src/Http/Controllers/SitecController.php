<?php

namespace Siravel\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class SitecController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $routeBase;

    protected $repository;

    public function __construct()
    {
        $this->routeBase = config('siravel.backend-route-prefix', 'siravel');
    }

    protected function getFeature(string $model): string
    {
        $isModels = [
            'page',
            'link',
            'menu',
            'plan',
        ];
        if (in_array($model, $isModels)) {
            return 'Negocios';
        }

        return 'System';

    }
}

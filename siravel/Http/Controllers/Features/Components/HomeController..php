<?php

namespace Siravel\Http\Controllers\Features\Components;

use Siravel\Http\Controllers\Controller as BaseController;
use Exception;
use Throwable;


class HomeController extends BaseController
{

    public function index()
    {
        $trainnings = [];
        return view('components.dashboards.components', compact('trainnings'));
    }

    
}

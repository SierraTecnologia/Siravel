<?php

namespace Siravel\Http\Controllers\Components;

use SiObject\Http\Controllers\Controller as BaseController;
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

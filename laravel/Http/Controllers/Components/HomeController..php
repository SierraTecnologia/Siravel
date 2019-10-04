<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller as BaseController;
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

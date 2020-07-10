<?php

namespace Siravel\Http\Controllers\Features\Travels;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Siravel\Http\Controllers\Features\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
}

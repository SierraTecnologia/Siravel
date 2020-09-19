<?php 
namespace Siravel\Http\Controllers\Features\Girl;

use Siravel\Http\Controllers\Features\Controller as BaseController;

class GirlController extends BaseController
{

    /**
     * Initializer.
     *
     * @return \AdminController
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

}
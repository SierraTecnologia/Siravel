<?php 
namespace App\Http\Controllers\Girl;

class GirlController extends Controller {

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
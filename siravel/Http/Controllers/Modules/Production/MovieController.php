<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Movie;
use App\MovieCategory;
use App\Language;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Admin\MovieRequest;
use Illuminate\Support\Facades\Auth;
use Datatables;

class MovieController extends Controller {

    public function __construct()
    {
        view()->share('type', 'movie');
    }
    
    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.movie.index');
    }

    public function menu()
    {
        $this->menu[ProductionType::$MOVIE][Stage::$ESBOCO] = [
            
        ];

        $this->menu[ProductionType::$MOVIE][Stage::$HISTORY] = [
            
        ];

        $this->menu[ProductionType::$MOVIE][Stage::$ROTEIRO] = [
            'history'
        ];

        $this->menu[ProductionType::$MOVIE][Stage::$PRODUCTION] = [

            // Cenas Restantes
            'scenes'
        ];
    }
}

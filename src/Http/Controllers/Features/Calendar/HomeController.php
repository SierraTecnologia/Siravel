<?php

namespace Siravel\Http\Controllers\Features\Calendar;

use Siravel\Http\Controllers\Features\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Admin\ArticleRequest;
use Illuminate\Support\Facades\Auth;
use Datatables;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        view()->share('type', 'home');
    }
    
    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        // Show the page
        return view('features.gp.home.index');
    }

    public function menu()
    {
        $this->menu[] = 'Agendamentos';
        $this->menu[] = 'Historico';
        $this->menu[] = 'Agendamentos';
        $this->menu[] = 'Agendamentos';
    }
}

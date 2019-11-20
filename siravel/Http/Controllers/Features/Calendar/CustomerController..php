<?php

namespace App\Http\Controllers\Features\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Siravel\Http\Requests\Admin\ArticleRequest;
use Illuminate\Support\Facades\Auth;
use Datatables;

class CustomerController extends Controller {

    public function __construct()
    {
        view()->share('type', 'customers');
    }
    
    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function garjeta()
    {
        // Show the page
        return view('features.gp.customers.index');
    }

    public function menu()
    {
        $this->menu[] = 'Agendamentos';
        $this->menu[] = 'Historico';
        $this->menu[] = 'Agendamentos';
        $this->menu[] = 'Agendamentos';
    }
}

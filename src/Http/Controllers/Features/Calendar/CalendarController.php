<?php

namespace Siravel\Http\Controllers\Features\Calendar;

use Siravel\Http\Controllers\Features\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Admin\ArticleRequest;
use Illuminate\Support\Facades\Auth;
use DataTables as Datatables;

class CalendarController extends Controller
{

    public function __construct()
    {
        view()->share('type', 'customers');
    }
    
    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function garjeta()
    {
        // Show the page
        return view('features.gp.customers.index');
    }

    public function menu(): void
    {
        $this->menu[] = 'Agendamentos';
        $this->menu[] = 'Historico';
        $this->menu[] = 'Agendamentos';
        $this->menu[] = 'Agendamentos';
    }
}

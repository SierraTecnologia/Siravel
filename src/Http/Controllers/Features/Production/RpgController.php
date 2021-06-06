<?php

namespace Siravel\Http\Controllers\Features\Production;

use Siravel\Http\Controllers\Features\Controller;
use App\Models\Rpg;
use App\Models\RpgCategory;
use App\Models\Language;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Admin\RpgRequest;
use Illuminate\Support\Facades\Auth;
use DataTables as Datatables;
use Illuminate\Http\Request;

class RpgController extends Controller
{

    public function __construct()
    {
        view()->share('type', 'rpg');
    }
    
    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        // Show the page
        return view('features.admin.rpg.index');
    }

    public function menu()
    {
        $this->menu[ProductionType::$RPG][Stage::$ESBOCO] = [

        ];

        $this->menu[ProductionType::$RPG][Stage::$HISTORY] = [
            
        ];

        $this->menu[ProductionType::$RPG][Stage::$ROTEIRO] = [
            
        ];

        $this->menu[ProductionType::$RPG][Stage::$PRODUCTION] = [
            
        ];
    }
}

<?php

/**
 * Bdsm
 */

namespace Siravel\Http\Controllers\Features\Fa;

use Siravel\Http\Controllers\Features\Controller as BaseController;
use Illuminate\Http\Request;

class FaController extends BaseController
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $dashboard = [];

        return view('features.fas.index', compact('dashboard'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function babies()
    {
        $babies = Fa::paginate(5);
        $babies->setPath('babies/');

        return view('features.fas.babies', compact('babies'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function slaves()
    {
        $slaves = Fa::paginate(5);
        $slaves->setPath('slaves/');

        return view('features.fas.slaves', compact('slaves'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function dommes()
    {
        $dommes = Fa::paginate(5);
        $dommes->setPath('dommes/');

        return view('features.fas.dommes', compact('dommes'));
    }

}

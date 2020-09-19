<?php

/**
 * Bdsm
 */

namespace Siravel\Http\Controllers\Features\Fa;

class RelationsController extends Controller
{

    public function index()
    {
        $dashboard = [];

        return view('features.fas.index', compact('dashboard'));
    }

    public function babies()
    {
        $babies = Fa::paginate(5);
        $babies->setPath('babies/');

        return view('features.fas.babies', compact('babies'));
    }

    public function slaves()
    {
        $slaves = Fa::paginate(5);
        $slaves->setPath('slaves/');

        return view('features.fas.slaves', compact('slaves'));
    }

    public function dommes()
    {
        $dommes = Fa::paginate(5);
        $dommes->setPath('dommes/');

        return view('features.fas.dommes', compact('dommes'));
    }

}

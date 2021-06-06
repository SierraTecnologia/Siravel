<?php

namespace Siravel\Http\Controllers\Features;

use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($moduleName)
    {
        $board = \Siravel\Features\Board($this->getModule($moduleName));
        return view('features.home', compact('board'));
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($moduleName)
    {
        return view('features.home', compact('conversations'));
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($moduleName)
    {
        return view('features.home', compact('conversations'));
    }

    public function getModule($name)
    {
        $features = config('siravel.active-core-features');
        return $features[$name];
    }
}

<?php

namespace Siravel\Http\Controllers\Pages;

use Illuminate\Http\Request;

class DashController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $links = [];
        return view(
            'siravel::pages.dash.index',
            compact('links')
        );
    }

}

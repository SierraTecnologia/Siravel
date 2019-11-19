<?php

namespace Siravel\Http\Controllers\Pages;

use Illuminate\Http\Request;

class DashController extends Controller
{
	public function index(Request $request)
	{
        $links = [];
        return view(
            'siravel::pages.dash.index',
            compact('links')
        );
	}

}

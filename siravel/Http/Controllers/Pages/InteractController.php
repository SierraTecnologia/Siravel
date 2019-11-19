<?php

namespace Siravel\Http\Controllers\Pages;

use Illuminate\Http\Request;

class InteractController extends Controller
{
	public function index(Request $request)
	{
        $links = [];
        return view(
            'siravel::pages.interact.index',
            compact('links')
        );
	}

}

<?php

namespace Siravel\Http\Controllers\Pages;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
	public function index(Request $request)
	{
        $links = [];
        return view(
            'siravel::pages.profile.index',
            compact('links')
        );
	}

}

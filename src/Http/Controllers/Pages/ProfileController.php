<?php

namespace Siravel\Http\Controllers\Pages;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $links = [];
        return view(
            'siravel::pages.profile.index',
            compact('links')
        );
    }

}

<?php

namespace Siravel\Http\Controllers\Features\Travels;

class UserController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getHome()
    {

        return view('features.panels.user.home');

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getProtected()
    {

        return view('features.panels.user.protected');

    }

}
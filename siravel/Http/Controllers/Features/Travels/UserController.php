<?php

namespace Siravel\Http\Controllers\Features\Travels;

class UserController extends Controller
{

    public function getHome()
    {

        return view('features.panels.user.home');

    }

    public function getProtected()
    {

        return view('features.panels.user.protected');

    }

}
<?php

namespace Siravel\Http\Controllers\Pages;

use Illuminate\Http\Request;

class InteractController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $links = [];
        return view(
            'siravel::pages.interact.index',
            compact('links')
        );
    }





    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function completeProfile(Request $request)
    {
        $links = [];
        return view(
            'siravel::pages.interact.index',
            compact('links')
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function opineSobre(Request $request)
    {
        $links = [];
        return view(
            'siravel::pages.interact.index',
            compact('links')
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function desejos(Request $request)
    {
        $links = [];
        return view(
            'siravel::pages.interact.index',
            compact('links')
        );
    }




    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function insertData(Request $request)
    {
        $links = [];
        return view(
            'siravel::pages.interact.index',
            compact('links')
        );
    }






    /**
     * Interacao
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function question(Request $request)
    {
        $links = [];
        return view(
            'siravel::pages.interact.index',
            compact('links')
        );
    }

}

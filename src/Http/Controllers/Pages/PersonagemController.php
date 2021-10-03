<?php

namespace Siravel\Http\Controllers\Pages;

use Illuminate\Http\Request;

class PersonagemController extends Controller
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





    // public function index(Request $request)
    // {
    //     $links = [];
    //     return view(
    //         'siravel::pages.interact.index',
    //         compact('links')
    //     );
    // }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function indexx(Request $request)
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
    public function indexxx(Request $request)
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

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





	public function completeProfile(Request $request)
	{
        $links = [];
        return view(
            'siravel::pages.interact.index',
            compact('links')
        );
	}

	public function opineSobre(Request $request)
	{
        $links = [];
        return view(
            'siravel::pages.interact.index',
            compact('links')
        );
	}

	public function desejos(Request $request)
	{
        $links = [];
        return view(
            'siravel::pages.interact.index',
            compact('links')
        );
	}




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

<?php

namespace Siravel\Http\Controllers\Api;

use Illuminate\Http\Request;
use Siravel\Plugins\Integrations\SitecPayment\SitecPayment;
use Auth;

class SupportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $myTickets = SitecPayment::getTickets();

        return view('home', compact('myTickets'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        return view('home', compact('ticketInContent'));
    }

    public function new($toId)
    {
        $user = Auth::user();
        $response = SitecPayment::createTicket($project, $name, $howToReprodute);
        return view('home', compact('ticketInContent'));
    }

    public function show($ticketId)
    {
        $ticketInContent = SitecPayment::showTicket($ticketId);
        return view('home', compact('ticketInContent'));
    }
}

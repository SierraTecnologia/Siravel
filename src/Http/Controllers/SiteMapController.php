<?php

namespace Siravel\Http\Controllers;

use Pedreiro\Services\RiCaService;
use Illuminate\Http\Response;

class SiteMapController extends SitecController
{
    protected $service;

    public function __construct(RiCaService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    public function index(Request $request)
    {
        $items = $this->service->collectSiteMapItems();

        $contents = view('site-map', compact('items'));

        return new Response(
            $contents, 200, [
            'Content-Type' => 'application/xml;charset=UTF-8',
            ]
        );
    }
}

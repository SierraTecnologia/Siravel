<?php

namespace Siravel\Http\Controllers;

use Support\Services\RiCaService;
use Illuminate\Http\Response;

class SiteMapController extends SitecController
{
    protected $service;

    public function __construct(RiCaService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    public function index()
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

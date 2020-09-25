<?php

namespace Siravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RssController extends SitecController
{
    protected $repo;

    public function __construct(Request $request)
    {
        parent::__construct();

        $url = $request->segment(1) ?? 'page';

        $this->module = str_singular($url);

        if (! empty($this->module)) {
            $this->repo = app('Siravel\Repositories\\'.$this->getFeature($this->module).'\\'.ucfirst($this->module).'Repository');
        }
    }

    public function index(Request $request)
    {
        $module = $this->module;

        $meta = \Illuminate\Support\Facades\Config::get(
            'siravel.rss', [
            'title' => \Illuminate\Support\Facades\Config::get('app.name'),
            'link' => url('/'),
            ]
        );

        $items = $this->repo->published();

        $contents = view('rss', compact('items', 'meta', 'module'));

        return new Response(
            $contents, 200, [
            'Content-Type' => 'application/xml;charset=UTF-8',
            ]
        );
    }
}

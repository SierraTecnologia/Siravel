<?php

namespace Siravel\Http\Controllers\Api;

use Illuminate\Http\Request;
use Siravel\Plugins\Integrations\SitecPayment\SitecPayment;
use Auth;
use League\Flysystem\Adapter\Local;
use League\Flysystem\File;
use League\Flysystem\Filesystem;


class MidiaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return void
     */
    public function index(Request $request): void
    {
        $midias = [];

        // Configuration (change it properly)
        $path = env('folder_location_photos');

        $filesystem = new Filesystem(new Local($path));

        $contents = $filesystem->listContents($path, true);
        foreach ($contents as $object) {
            echo $object['basename'].' is located at '.$object['path'].' and is a '.$object['type'];
        }
        
        // dd($midias);
    }
}

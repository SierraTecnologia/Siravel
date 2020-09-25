<?php 

namespace Siravel\Http\Controllers\Admin;

use Siravel\Models\Blog\Article;
use Siravel\Models\Blog\Category;
use Siravel\Models\Negocios\Client;
use Stalker\Models\Photo;
use Stalker\Models\PhotoAlbum;

class ClientController extends Controller
{


    public function index(Request $request)
    {

        $clients = Client::count();
        return view('admin.clients.index',  compact('clients'));
    }
}
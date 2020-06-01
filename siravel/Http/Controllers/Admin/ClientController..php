<?php 

namespace App\Http\Controllers\Admin;

use App\Models\Blog\Article;
use App\Models\Blog\Category;
use App\Models\Negocios\Client;
use Siravel\Models\Digital\Midia\Photo;
use Siravel\Models\Digital\Midia\PhotoAlbum;

class ClientController extends Controller {


	public function index()
	{

        $clients = Client::count();
		return view('admin.clients.index',  compact('clients'));
	}
}
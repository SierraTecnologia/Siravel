<?php namespace Siravel\Http\Controllers\Admin;

use Siravel\Models\Blog\Article;
use Siravel\Models\Blog\Category;
use Siravel\Models\Identity\Girl;
use Stalker\Models\Photo;
use Stalker\Models\PhotoAlbum;

class GirlController extends Controller {


	public function index()
	{

        $girls = Girl::count();
		return view('admin.girls.index',  compact('girls'));
	}
}
<?php namespace Siravel\Http\Controllers\Girl;

use Siravel\Http\Controllers\GirlController;
use Siravel\Models\Blog\Article;
use Siravel\Models\Blog\Category;
use Siravel\Models\User;
use Siravel\Models\Digital\Midia\Photo;
use Siravel\Models\Digital\Midia\PhotoAlbum;

class DashboardController extends GirlController {

    public function __construct()
    {
        parent::__construct();
        view()->share('type', '');
    }

	public function index()
	{
        $title = "Dashboard";

        $fas = '';
        $

        $news = Article::count();
        $newscategory = Category::count();
        $users = User::count();
        $photo = Photo::count();
        $photoalbum = PhotoAlbum::count();
		return view('features.girl.dashboard.index',  compact('title','news','newscategory','photo','photoalbum','users'));
	}
}
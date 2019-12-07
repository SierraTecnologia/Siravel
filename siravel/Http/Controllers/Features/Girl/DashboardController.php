<?php

namespace App\Http\Controllers\Features\Girl;

use App\Http\Controllers\GirlController;
use App\Models\Blog\Article;
use App\Models\Blog\Category;
use App\Models\User;
use Informate\Models\Entytys\Digital\Midia\Photo;
use Informate\Models\Entytys\Digital\Midia\PhotoAlbum;

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
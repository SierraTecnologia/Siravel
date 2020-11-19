<?php namespace Siravel\Http\Controllers\Features\Girl;

use Siravel\Http\Controllers\Features\Girl\GirlController;
use App\Models\Blog\Article;
use App\Models\Blog\Category;
use App\Models\User;
use Stalker\Models\Photo;
use Stalker\Models\PhotoAlbum;
use Illuminate\Http\Request;

class DashboardController extends GirlController
{

    public function __construct()
    {
        parent::__construct();
        view()->share('type', '');
    }

    public function index(Request $request)
    {
        $title = "Dashboard";

        $fas = '';
        

        $news = Article::count();
        $newscategory = Category::count();
        $users = User::count();
        $photo = Photo::count();
        $photoalbum = PhotoAlbum::count();
        return view('features.girl.dashboard.index',  compact('title', 'news', 'newscategory', 'photo', 'photoalbum', 'users'));
    }
}
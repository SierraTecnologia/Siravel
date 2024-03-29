<?php namespace Siravel\Http\Controllers\Admin;

use Siravel\Models\Blog\Article;
use Siravel\Models\Blog\Category;
use Siravel\Models\Identity\Girl;
use Stalker\Models\Photo;
use Stalker\Models\PhotoAlbum;
use Illuminate\Http\Request;

class GirlController extends Controller
{


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {

        $girls = Girl::count();
        return view('admin.girls.index',  compact('girls'));
    }
}
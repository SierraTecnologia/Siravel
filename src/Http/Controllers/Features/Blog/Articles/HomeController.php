<?php

namespace Siravel\Http\Controllers\Features\Blog\Articles;

use App\Models\Tag;
use App\Models\Post;
use Informate\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts      = Post::count();
        $comments   = Comment::count();
        $tags       = Tag::count();
        $categories = Category::count();

        return view('features.home', get_defined_vars());
    }
}

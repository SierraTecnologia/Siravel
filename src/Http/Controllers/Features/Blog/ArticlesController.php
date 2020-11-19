<?php

namespace Siravel\Http\Controllers\Features\Blog;

use App\Models\Blog\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    public function index(Request $request)
    {
        $articles = Article::paginate(5);
        $articles->setPath('articles/');

        return view('features.article.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::findBySlugOrId($slug);

        return view('features.article.view', compact('article'));
    }

}

<?php

namespace Siravel\Http\Controllers\Features\Girl;

use Siravel\Http\Controllers\Features\Girl\GirlController;
use App\Models\Blog\Article;
use App\Models\Blog\Category;
use Translation\Models\Language;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Admin\ArticleRequest;
use Illuminate\Support\Facades\Auth;
use DataTables as Datatables;
use Illuminate\Http\Request;

class ArticleController extends GirlController
{

    public function __construct()
    {
        view()->share('type', 'article');
    }
     /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Show the page
        return view('features.girl.article.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $languages = Language::all()->pluck('name', 'id')->toArray();
        $articlecategories = Category::all()->pluck('title', 'id')->toArray();
        return view('features.girl.article.create_edit', compact('languages', 'articlecategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(ArticleRequest $request): void
    {
        $article = new Article($request->except('image'));
        $article -> user_id = Auth::id();

        $picture = "";
        if(Input::hasFile('image')) {
            $file = Input::file('image');
            $filename = $file->getClientOriginalName();
            $extension = $file -> getClientOriginalExtension();
            $picture = sha1($filename . time()) . '.' . $extension;
        }
        $article -> picture = $picture;
        $article -> save();

        if(Input::hasFile('image')) {
            $destinationPath = public_path() . '/images/article/'.$article->id.'/';
            Input::file('image')->move($destinationPath, $picture);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Article $article)
    {
        $languages = Language::all()->pluck('name', 'id')->toArray();
        $articlecategories = Category::all()->pluck('title', 'id')->toArray();
        return view('features.girl.article.create_edit', compact('article', 'languages', 'articlecategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return void
     */
    public function update(ArticleRequest $request, Article $article): void
    {
        $article -> user_id = Auth::id();
        $picture = "";
        if(Input::hasFile('image')) {
            $file = Input::file('image');
            $filename = $file->getClientOriginalName();
            $extension = $file -> getClientOriginalExtension();
            $picture = sha1($filename . time()) . '.' . $extension;
        }
        $article -> picture = $picture;
        $article -> update($request->except('image'));

        if(Input::hasFile('image')) {
            $destinationPath = public_path() . '/images/article/'.$article->id.'/';
            Input::file('image')->move($destinationPath, $picture);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(Article $article)
    {
        return view('features.girl.article.delete', compact('article'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return void
     */
    public function destroy(Article $article): void
    {
        $article->delete();
    }


    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $articles = Article::with('category', 'language')
            ->get()
            ->map(
                function ($article) {
                    return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'category' => isset($article->category)?$article->category->title:"",
                    'language' => isset($article->language)?$article->language->name:"",
                    'created_at' => $article->created_at->format('d.m.Y.'),
                    ];
                }
            );
        return Datatables::of($articles)
            ->addColumn(
                'actions', '<a href="{{{ url(\'girl/article/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/article/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                    <input type="hidden" name="row" value="{{$id}}" id="row">'
            )
            ->removeColumn('id')

            ->make();
    }
}

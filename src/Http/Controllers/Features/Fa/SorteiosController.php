<?php

namespace Siravel\Http\Controllers\Features\Fa;

use App\Models\Blog\Category;
use Translation\Models\Language;
use Siravel\Http\Controllers\Features\AdminController;
use App\Http\Requests\Admin\ArticleCategoryRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\ReorderRequest;
use Illuminate\Support\Facades\Auth;
use DataTables as Datatables;
use Illuminate\Http\Request;

class SorteiosController extends FaController
{

    public function __construct()
    {
        view()->share('type', 'articlecategory');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('features.girl.articlecategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $languages = Language::all()->pluck('name', 'id')->toArray();
        return view('features.girl.articlecategory.create_edit', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(ArticleCategoryRequest $request): void
    {
        $articlecategory = new ArticleCategory($request->all());
        $articlecategory->user_id = Auth::id();
        $articlecategory->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(ArticleCategory $articlecategory)
    {
        $languages = Language::all()->pluck('name', 'id')->toArray();
        return view('features.girl.articlecategory.create_edit', compact('articlecategory', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return void
     */
    public function update(ArticleCategoryRequest $request, ArticleCategory $articlecategory): void
    {
        $articlecategory->user_id_edited = Auth::id();
        $articlecategory->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(ArticleCategory $articlecategory)
    {
        return view('features.girl.articlecategory.delete', compact('articlecategory'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return void
     */
    public function destroy(ArticleCategory $articleCategory): void
    {
        $articleCategory->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $article_categories = ArticleCategory::with('language')
            ->get()
            ->map(
                function ($article_category) {
                    return [
                    'id' => $article_category->id,
                    'title' => $article_category->title,
                    'language' => isset($article_category->language) ? $article_category->language->name : "",
                    'created_at' => $article_category->created_at->format('d.m.Y.'),
                    ];
                }
            );
        return Datatables::of($article_categories)
            ->addColumn(
                'actions', '<a href="{{{ url(\'admin/articlecategory/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                <a href="{{{ url(\'admin/articlecategory/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                <input type="hidden" name="row" value="{{$id}}" id="row">'
            )
            ->removeColumn('id')
            ->make();
    }

    /**
     * Reorder items
     *
     * @param  items list
     * @return items from @param
     */
    public function getReorder(ReorderRequest $request)
    {
        $list = $request->list;
        $items = explode(",", $list);
        $order = 1;
        foreach ($items as $value) {
            if ($value != '') {
                ArticleCategory::where('id', '=', $value)->update(array('position' => $order));
                $order++;
            }
        }
        return $list;
    }

}

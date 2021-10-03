<?php

namespace Siravel\Http\Controllers\Features\Girl;

use Siravel\Http\Controllers\Features\AdminController;
use Illuminate\Support\Facades\Input;
use Translation\Models\Language;
use App\Http\Requests\Admin\LanguageRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\ReorderRequest;
use Illuminate\Support\Facades\Auth;
use DataTables as Datatables;
use Illuminate\Http\Request;

class LanguageController extends GirlController
{

    public function __construct()
    {
        view()->share('type', 'language');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Show the page
        return view('features.girl.language.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
          // Show the page
        return view('features.girl/language/create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(LanguageRequest $request): void
    {
        $language = new Language($request->all());
        $language -> user_id = Auth::id();
        $language -> save();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Language $language)
    {
        return view('features.girl/language/create_edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return void
     */
    public function update(LanguageRequest $request, Language $language): void
    {
        $language -> user_id_edited = Auth::id();
        $language -> update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(Language $language)
    {
        // Show the page
        return view('features.girl/language/delete', compact('language'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return void
     */
    public function destroy(Language $language): void
    {
        $language->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $languages = Language::whereNull('languages.deleted_at')
            ->orderBy('languages.position', 'ASC')
            ->get()
            ->map(
                function ($language) {
                        return [
                        'id' => $language->id,
                        'name' => $language->name,
                        'code' => $language->code,
                        'icon' => $language->code,
                        ];
                }
            );
        return Datatables::of($languages)
            ->editColumn('icon', '<img src="blank.gif" class="flag flag-{{$icon}}" alt="" />')

            ->addColumn(
                'actions', '<a href="{{{ url(\'girl/language/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/language/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                    <input type="hidden" name="row" value="{{$id}}" id="row">'
            )
            ->removeColumn('id')

            ->make();
    }

}

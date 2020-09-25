<?php

namespace Siravel\Http\Controllers\Girl;

use Siravel\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use Translation\Models\Language;
use Siravel\Http\Requests\Admin\LanguageRequest;
use Siravel\Http\Requests\Admin\DeleteRequest;
use Siravel\Http\Requests\Admin\ReorderRequest;
use Illuminate\Support\Facades\Auth;
use Datatables;

class LanguageController extends GirlController
{

    public function __construct()
    {
        view()->share('type', 'language');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // Show the page
        return view('features.girl.language.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
          // Show the page
        return view('features.girl/language/create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(LanguageRequest $request)
    {
        $language = new Language($request->all());
        $language -> user_id = Auth::id();
        $language -> save();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit(Language $language)
    {
        return view('features.girl/language/create_edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(LanguageRequest $request, Language $language)
    {
        $language -> user_id_edited = Auth::id();
        $language -> update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return Response
     */

    public function delete(Language $language)
    {
        // Show the page
        return view('features.girl/language/delete', compact('language'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return Response
     */
    public function destroy(Language $language)
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
            ->edit_column('icon', '<img src="blank.gif" class="flag flag-{{$icon}}" alt="" />')

            ->add_column(
                'actions', '<a href="{{{ url(\'girl/language/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/language/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                    <input type="hidden" name="row" value="{{$id}}" id="row">'
            )
            ->remove_column('id')

            ->make();
    }

}

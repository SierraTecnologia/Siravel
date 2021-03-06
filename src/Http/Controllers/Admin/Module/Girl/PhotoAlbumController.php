<?php namespace Siravel\Http\Controllers\Girl;

use Stalker\Models\PhotoAlbum;
use Stalker\Models\Photo;
use Translation\Models\Language;
use Siravel\Http\Controllers\GirlController;
use Siravel\Http\Requests\Admin\PhotoAlbumRequest;
use Illuminate\Support\Facades\Auth;
use DataTables as Datatables;

class PhotoAlbumController extends GirlController
{

    public function __construct()
    {
        view()->share('type', 'photoalbum');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        // Show the page
        return view('stalker::admin.photoalbum.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $languages = Language::all()->pluck('name', 'id')->toArray();
        return view('stalker::admin.photoalbum.create_edit', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PhotoAlbumRequest $request)
    {
        $photoalbum = new PhotoAlbum($request->all());
        $photoalbum->user_id = Auth::id();
        $photoalbum->folder_id = sha1($request->name . time());
        $photoalbum->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit(PhotoAlbum $photoalbum)
    {
        $languages = Language::all()->pluck('name', 'id')->toArray();
        return view('stalker::admin.photoalbum.create_edit', compact('photoalbum', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(PhotoAlbumRequest $request, PhotoAlbum $photoalbum)
    {
        $photoalbum->user_id_edited = Auth::id();
        $photoalbum->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return Response
     */

    public function delete(PhotoAlbum $photoalbum)
    {
        return view('stalker::admin.photoalbum.delete', compact('photoalbum'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return Response
     */
    public function destroy(PhotoAlbum $photoalbum)
    {
        $photoalbum->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $photo_albums = PhotoAlbum::with('language')
            ->get()
            ->map(
                function ($photo_album) {
                    return [
                    'id' => $photo_album->id,
                    'title' => $photo_album->title,
                    'language' => isset($photo_album->language) ? $photo_album->language->name : "",
                    'created_at' => $photo_album->created_at->format('d.m.Y.'),
                    ];
                }
            );

        return Datatables::of($photo_albums)
            ->editColumn('images_count', '<a class="btn btn-primary btn-sm" >{{ \App\Photo::where(\'photo_album_id\', \'=\', $id)->count() }}</a>')
            ->addColumn(
                'actions', '<a href="{{{ url(\'girl/photoalbum/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("girl/modal.edit") }}</a>
                    <a href="{{{ url(\'girl/photoalbum/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("girl/modal.delete") }}</a>
                    <input type="hidden" name="row" value="{{$id}}" id="row">'
            )
            ->removeColumn('id')
            ->make();
    }

}

<?php 
namespace SiObject\Http\Controllers\Midia;

use App\Models\Midia\Photo;
use App\Models\Midia\PhotoAlbum;

class PhotoController extends Controller {

    public function show($id)
	{
        $photo_album = PhotoAlbum::find($id);
        $photos = Photo::where('photo_album_id', $id)->get();

        return view('photo.view_album',compact('photos','photo_album'));
	}

}

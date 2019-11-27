<?php 

namespace App\Http\Controllers\Features\Midia;

use Siravel\Models\Digital\Midia\Photo;
use Siravel\Models\Digital\Midia\PhotoAlbum;
use Siravel\Services\Midia\MidiaService;
use App\Http\Controllers\Controller;

class MidiaController extends Controller {


    public function __construct(MidiaService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Provide the File as a Public Preview.
     *
     * @param string $encFileName
     *
     * @return Download
     */
    public function asPreview($midia)
    {
        return $this->service->asPreview($midia);
    }

    /**
     * Provide file as download.
     *
     * @param string $encFileName
     * @param string $encRealFileName
     *
     * @return Downlaod
     */
    public function asFull($midia)
    {
        return $this->service->asFull($midia);
    }

    /**
     * Provide file as download.
     *
     * @param string $encFileName
     * @param string $encRealFileName
     *
     * @return Downlaod
     */
    public function asDownload($midia)
    {
        return $this->service->asDownload($midia);
    }


    // public function show($id)
	// {
    //     $photo_album = PhotoAlbum::find($id);
    //     $photos = Photo::where('photo_album_id', $id)->get();

    //     return view('features.photo.view_album',compact('photos','photo_album'));
	// }

}
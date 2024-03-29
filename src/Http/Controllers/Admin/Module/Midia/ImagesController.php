<?php

namespace Siravel\Http\Controllers\Admin\Midia;

use Config;
use Crypto;
use FileService;
use Illuminate\Http\Request;
use Siravel;
use Storage;
use Facilitador\Models\Image;
use MediaManager\Repositories\ImageRepository;
use Siravel\Http\Requests\ImagesRequest;
use Muleta\Modules\Controllers\Api\ApiControllerTrait;
use Muleta\Services\ValidationService;
use Siravel\Http\Controllers\Admin\Controller as BaseController;

class ImagesController extends BaseController
{
    use ApiControllerTrait;
    
    public function __construct(ImageRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Images.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $input = $request->all();

        $result = $this->repository->paginated();

        return view('siravel::admin.features.midia.images.index')
            ->with('images', $result)
            ->with('pagination', $result->render());
    }

    /**
     * Search.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request)
    {
        $input = $request->all();

        $result = $this->repository->search($input);

        return view('siravel::admin.features.midia.images.index')
            ->with('images', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Images.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        return view('siravel::admin.features.midia.images.create');
    }

    /**
     * Store a newly created Images in storage.
     *
     * @param ImagesRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $validation = app(ValidationService::class)->check(['location' => 'required']);
            if (!$validation['errors']) {
                foreach ($request->input('location') as $image) {
                    $imageSaved = $this->repository->store(
                        [
                        'location' => $image,
                        'is_published' => $request->input('is_published'),
                        'tags' => $request->input('tags'),
                        ]
                    );
                }

                Siravel::notification('Image saved successfully.', 'success');

                if (!$imageSaved) {
                    Siravel::notification('Image was not saved.', 'danger');
                }
            } else {
                Siravel::notification('Image could not be saved', 'danger');

                return $validation['redirect'];
            }
        } catch (Exception $e) {
            Siravel::notification($e->getMessage() ?: 'Image could not be saved.', 'danger');
        }

        return redirect(route('admin.media-manager.images.index'));
    }

    /**
     * Store a newly created Files in storage.
     *
     * @param Request $request
     *
     * @return \Response
     */
    public function upload(Request $request): \Response
    {
        $validation = app(ValidationService::class)->check(
            [
            'location' => ['required'],
            ]
        );

        if (!$validation['errors']) {
            $file = $request->file('location');
            $fileSaved = app(FileService::class)->saveFile($file, 'public/images', [], true);
            $fileSaved['name'] = Crypto::encrypt($fileSaved['name']);
            $fileSaved['mime'] = $file->getClientMimeType();
            $fileSaved['size'] = $file->getClientSize();
            $response = $this->apiResponse('success', $fileSaved);
        } else {
            $response = $this->apiErrorResponse($validation['errors'], $validation['inputs']);
        }

        return $response;
    }

    /**
     * Show the form for editing the specified Images.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $images = $this->repository->find($id);

        if (empty($images)) {
            Siravel::notification('Image not found', 'warning');

            return redirect(route('admin.media-manager.images.index'));
        }

        return view('siravel::admin.features.midia.images.edit')->with('images', $images);
    }

    /**
     * Update the specified Images in storage.
     *
     * @param int           $id
     * @param ImagesRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, ImagesRequest $request)
    {
        try {
            $images = $this->repository->find($id);

            Siravel::notification('Image updated successfully.', 'success');

            if (empty($images)) {
                Siravel::notification('Image not found', 'warning');

                return redirect(route('admin.media-manager.images.index'));
            }

            $images = $this->repository->update($images, $request->all());

            if (!$images) {
                Siravel::notification('Image could not be updated', 'danger');
            }
        } catch (Exception $e) {
            Siravel::notification($e->getMessage() ?: 'Image could not be saved.', 'danger');
        }

        return redirect(route('admin.media-manager.images.edit', $id));
    }

    /**
     * Remove the specified Images from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        $image = $this->repository->find($id);

        if (is_file(storage_path($image->location))) {
            Storage::delete($image->location);
        } else {
            Storage::disk(Config::get('siravel.storage-location', 'local'))->delete($image->location);
        }

        if (empty($image)) {
            Siravel::notification('Image not found', 'warning');

            return redirect(route('admin.media-manager.images.index'));
        }

        $image->forgetCache();
        $image->delete();

        Siravel::notification('Image deleted successfully.', 'success');

        return redirect(route('admin.media-manager.images.index'));
    }

    /**
     * Bulk image delete
     *
     * @param string $ids
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function bulkDelete($ids)
    {
        $ids = explode('-', $ids);

        foreach ($ids as $id) {
            $image = $this->repository->find($id);

            if (is_file(storage_path($image->location))) {
                Storage::delete($image->location);
            } else {
                Storage::disk(Config::get('siravel.storage-location', 'local'))->delete($image->location);
            }

            $image->delete();
        }

        Siravel::notification('Bulk Image deletes completed successfully.', 'success');

        return redirect(route('admin.media-manager.images.index'));
    }

    /*
    |--------------------------------------------------------------------------
    | Api
    |--------------------------------------------------------------------------
    */

    /**
     * Display the specified Images.
     *
     * @return \Response
     */
    public function apiList(Request $request): \Response
    {
        if (config('siravel.api-key') != $request->header('siravel')) {
            return $this->apiResponse('error', []);
        }

        $images =  $this->repository->apiPrepared();

        return $this->apiResponse('success', $images);
    }

    /**
     * Store a newly created Images in storage.
     *
     * @param ImagesRequest $request
     *
     * @return \Response
     */
    public function apiStore(Request $request): \Response
    {
        $image = $this->repository->apiStore($request->all());

        return $this->apiResponse('success', $image);
    }
}

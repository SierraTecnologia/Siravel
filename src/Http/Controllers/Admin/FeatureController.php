<?php

namespace Siravel\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Siravel\Http\Controllers\Controller;
use Siravel\Http\Requests\FeatureCreateRequest;
use Siravel\Http\Requests\FeatureUpdateRequest;
use Siravel\Services\FeatureService;

class FeatureController extends Controller
{
    public function __construct(FeatureService $featureService)
    {
        $this->service = $featureService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $features = $this->service->paginated();
        // dd($features);
        return view('siravel::admin.features.index')->with('features', $features);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $features = $this->service->search($request->search, null);
        return view('siravel::admin.features.index')->with('features', $features);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        return view('siravel::admin.features.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FeatureCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(FeatureCreateRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result && is_object($result)) {
            return redirect('admin/features/'.$result->id.'/edit')->with('message', 'Successfully created');
        } elseif ($result) {
            return redirect('admin/features')->with('message', 'Successfully created');
        }

        return redirect('admin/features')->with('errors', ['Failed to create']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $feature = $this->service->find($id);
        return view('siravel::admin.features.edit')->with('feature', $feature);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FeatureUpdateRequest $request
     * @param int                                   $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FeatureUpdateRequest $request, $id): self
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->with('errors', ['Failed to update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect('admin/features')->with('message', 'Successfully deleted');
        }

        return redirect('admin/features')->with('errors', ['Failed to delete']);
    }
}

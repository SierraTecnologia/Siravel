<?php

namespace App\Http\Controllers\Admin\Writelabel;

use URL;
use Cms;
use App\Models\Negocios\Faq;
use Illuminate\Http\Request;
use App\Http\Requests\FaqRequest;
use App\Repositories\FaqRepository;
use App\Services\ValidationService;
use App\Http\Controllers\Admin\Controller as BaseController;

class FaqController extends BaseController
{
    public function __construct(FaqRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Faq.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->repository->paginated();

        return view('admin.features.writelabel.faqs.index')
            ->with('faqs', $result)
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

        return view('admin.features.writelabel.faqs.index')
            ->with('faqs', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Faq.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.features.writelabel.faqs.create');
    }

    /**
     * Store a newly created Faq in storage.
     *
     * @param FaqRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = app(ValidationService::class)->check(Faq::$rules);

        if (!$validation['errors']) {
            $faq = $this->repository->store($request->all());
            Cms::notification('Faq saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$faq) {
            Cms::notification('Faq could not be saved.', 'warning');
        }

        return redirect(route('admin.faqs.edit', [$faq->id]));
    }

    /**
     * Show the form for editing the specified Faq.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $faq = $this->repository->find($id);

        if (empty($faq)) {
            Cms::notification('Faq not found', 'warning');

            return redirect(route('admin.faqs.index'));
        }

        return view('admin.features.writelabel.faqs.edit')->with('faq', $faq);
    }

    /**
     * Update the specified Faq in storage.
     *
     * @param int        $id
     * @param FaqRequest $request
     *
     * @return Response
     */
    public function update($id, FaqRequest $request)
    {
        $faq = $this->repository->find($id);

        if (empty($faq)) {
            Cms::notification('Faq not found', 'warning');

            return redirect(route('admin.faqs.index'));
        }

        $validation = app(ValidationService::class)->check(Faq::$rules);

        if (!$validation['errors']) {
            $faq = $this->repository->update($faq, $request->all());
            Cms::notification('Faq updated successfully.', 'success');

            if (!$faq) {
                Cms::notification('Faq could not be saved.', 'warning');
            }
        } else {
            return $validation['redirect'];
        }

        return redirect(URL::previous());
    }

    /**
     * Remove the specified Faq from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $faq = $this->repository->find($id);

        if (empty($faq)) {
            Cms::notification('Faq not found', 'warning');

            return redirect(route('admin.faqs.index'));
        }

        $faq->delete();

        Cms::notification('Faq deleted successfully.', 'success');

        return redirect(route('admin.faqs.index'));
    }
}

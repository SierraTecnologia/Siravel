<?php

namespace Siravel\Http\Controllers\Admin\Writelabel;

use Siravel;
use Siravel\Models\Negocios\Page;
use Illuminate\Http\Request;
use Siravel\Http\Requests\PagesRequest;
use Muleta\Services\ValidationService;
use Siravel\Repositories\Negocios\PageRepository;
use Siravel\Http\Controllers\Admin\Controller as BaseController;

class PagesController extends BaseController
{
    public function __construct(PageRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Pages.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $result = $this->repository->paginated();

        return view('siravel::admin.features.writelabel.pages.index')
            ->with('pages', $result)
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

        return view('siravel::admin.features.writelabel.pages.index')
            ->with('pages', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Pages.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        return view('siravel::admin.features.writelabel.pages.create');
    }

    /**
     * Store a newly created Pages in storage.
     *
     * @param PagesRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = app(ValidationService::class)->check(app(Page::class)->rules);

        if (!$validation['errors']) {
            $pages = $this->repository->store($request->all());
            Siravel::notification('Page saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$pages) {
            Siravel::notification('Page could not be saved.', 'warning');
        }

        return redirect(route('admin.pages.edit', [$pages->id]));
    }

    /**
     * Show the form for editing the specified Pages.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $page = $this->repository->find($id);

        if (empty($page)) {
            Siravel::notification('Page not found', 'warning');

            return redirect(route('admin.pages.index'));
        }

        return view('siravel::admin.features.writelabel.pages.edit')->with('page', $page);
    }

    /**
     * Update the specified Pages in storage.
     *
     * @param int          $id
     * @param PagesRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, PagesRequest $request)
    {
        $pages = $this->repository->find($id);

        if (empty($pages)) {
            Siravel::notification('Page not found', 'warning');

            return redirect(route('admin.pages.index'));
        }

        $pages = $this->repository->update($pages, $request->all());
        Siravel::notification('Page updated successfully.', 'success');

        if (!$pages) {
            Siravel::notification('Page could not be saved.', 'warning');
        }

        return redirect(url()->previous());
    }

    /**
     * Remove the specified Pages from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        $pages = $this->repository->find($id);

        if (empty($pages)) {
            Siravel::notification('Page not found', 'warning');

            return redirect(route('admin.pages.index'));
        }

        $pages->delete();

        Siravel::notification('Page deleted successfully.', 'success');

        return redirect(route('admin.pages.index'));
    }

    /**
     * Page history.
     *
     * @param int $id
     *
     * @return Response
     */
    public function history($id)
    {
        $page = $this->repository->find($id);

        return view('siravel::admin.features.writelabel.pages.history')
            ->with('page', $page);
    }
}

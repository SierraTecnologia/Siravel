<?php

namespace Siravel\Http\Controllers\Admin\Writelabel;

use Siravel;
use Exception;
use Siravel\Models\Negocios\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Siravel\Http\Requests\LinksRequest;
use Muleta\Services\ValidationService;
use Siravel\Repositories\Negocios\LinkRepository;
use Siravel\Http\Controllers\Admin\Controller as BaseController;

class LinksController extends BaseController
{
    public function __construct(LinkRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Links.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->repository->paginated();

        return view('admin.features.writelabel.links.index')
            ->with('links', $result)
            ->with('pagination', $result->render());
    }

    /**
     * Show the form for creating a new Links.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $menu = $request->get('m');

        return view('admin.features.writelabel.links.create')->with('menu_id', $menu);
    }

    /**
     * Store a newly created Links in storage.
     *
     * @param LinksRequest $request
     *
     * @return Response
     */
    public function store(LinksRequest $request)
    {
        try {
            $validation = app(ValidationService::class)->check(Link::$rules);

            if (!$validation['errors']) {
                $links = $this->repository->store($request->all());
                Siravel::notification('Link saved successfully.', 'success');

                if (!$links) {
                    Siravel::notification('Link could not be saved.', 'danger');
                }
            } else {
                return $validation['redirect'];
            }
        } catch (Exception $e) {
            Siravel::notification($e->getMessage() ?: 'Link could not be saved.', 'danger');
        }

        return redirect(route('admin.menus.edit', [$request->get('menu_id')]));
    }

    /**
     * Show the form for editing the specified Links.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $links = $this->repository->find($id);

        if (empty($links)) {
            Siravel::notification('Link not found', 'warning');

            return redirect(route('admin.links.index'));
        }

        return view('admin.features.writelabel.links.edit')->with('links', $links);
    }

    /**
     * Update the specified Links in storage.
     *
     * @param int          $id
     * @param LinksRequest $request
     *
     * @return Response
     */
    public function update($id, LinksRequest $request)
    {
        try {
            $links = $this->repository->find($id);

            if (empty($links)) {
                Siravel::notification('Link not found', 'warning');

                return redirect(route('admin.links.index'));
            }

            $links = $this->repository->update($links, $request->all());
            Siravel::notification('Link updated successfully.', 'success');

            if (!$links) {
                Siravel::notification('Link could not be updated.', 'danger');
            }
        } catch (Exception $e) {
            Siravel::notification($e->getMessage() ?: 'Links could not be updated.', 'danger');
        }

        return redirect(route('admin.links.edit', [$id]));
    }

    /**
     * Remove the specified Links from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $link = $this->repository->find($id);
        $menu = $link->menu_id;

        if (empty($link)) {
            Siravel::notification('Link not found', 'warning');

            return redirect(route('admin.menus.index'));
        }

        $order = json_decode($link->menu->order);
        $key = array_search($id, $order);
        unset($order[$key]);

        $link->menu->update(
            [
            'order' => json_encode(array_values($order)),
            ]
        );

        $link->delete();

        Siravel::notification('Link deleted successfully.', 'success');

        return redirect(route('admin.menus.edit', [$link->menu_id]));
    }
}

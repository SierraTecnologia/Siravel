<?php

namespace Siravel\Http\Controllers\Admin\Writelabel;

use Exception;
use Illuminate\Http\Request;
use Siravel;
use Siravel\Models\Negocios\Menu;
use Siravel\Repositories\Negocios\LinkRepository;
use Siravel\Repositories\Negocios\MenuRepository;
use Siravel\Http\Requests\MenuRequest;
use Support\Services\RiCaResponseService;
use Muleta\Services\ValidationService;
use Siravel\Http\Controllers\Admin\Controller as BaseController;

class MenuController extends BaseController
{
    protected $linkRepository;

    public function __construct(MenuRepository $repository, LinkRepository $linkRepository)
    {
        parent::__construct();

        $this->repository = $repository;
        $this->linkRepository = $linkRepository;
    }

    /**
     * Display a listing of the Menu.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->repository->paginated();

        return view('admin.features.writelabel.menus.index')
            ->with('menus', $result)
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

        return view('admin.features.writelabel.menus.index')
            ->with('menus', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Menu.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.features.writelabel.menus.create');
    }

    /**
     * Store a newly created Menu in storage.
     *
     * @param MenuRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $validation = app(ValidationService::class)->check(Menu::$rules);

            if (!$validation['errors']) {
                $menu = $this->repository->store($request->all());
                Siravel::notification('Menu saved successfully.', 'success');

                if (!$menu) {
                    Siravel::notification('Menu could not be saved.', 'danger');
                }
            } else {
                return $validation['redirect'];
            }
        } catch (Exception $e) {
            Siravel::notification($e->getMessage() ?: 'Menu could not be saved.', 'danger');
        }

        return redirect(route('admin.menus.edit', [$menu->id]));
    }

    /**
     * Show the form for editing the specified Menu.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $menu = $this->repository->find($id);

        if (empty($menu)) {
            Siravel::notification('Menu not found', 'warning');

            return redirect(route('admin.menus.index'));
        }

        $links = $this->linkRepository->getLinksByMenu($menu->id);

        return view('admin.features.writelabel.menus.edit')->with('menu', $menu)->with('links', $links);
    }

    /**
     * Update the specified Menu in storage.
     *
     * @param int         $id
     * @param MenuRequest $request
     *
     * @return Response
     */
    public function update($id, MenuRequest $request)
    {
        try {
            $menu = $this->repository->find($id);

            if (empty($menu)) {
                Siravel::notification('Menu not found', 'warning');

                return redirect(route('admin.menus.index'));
            }

            $menu = $this->repository->update($menu, $request->all());
            Siravel::notification('Menu updated successfully.', 'success');

            if (!$menu) {
                Siravel::notification('Menu could not be updated.', 'danger');
            }
        } catch (Exception $e) {
            Siravel::notification($e->getMessage() ?: 'Menu could not be updated.', 'danger');
        }

        return redirect(route('admin.menus.edit', [$id]));
    }

    /**
     * Remove the specified Menu from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $menu = $this->repository->find($id);

        if (empty($menu)) {
            Siravel::notification('Menu not found', 'warning');

            return redirect(route('admin.menus.index'));
        }

        $menu->delete();

        Siravel::notification('Menu deleted successfully.');

        return redirect(route('admin.menus.index'));
    }


    /*
    |--------------------------------------------------------------------------
    | Api
    |--------------------------------------------------------------------------
    */

    /**
     * Set the order
     *
     * @return Response
     */
    public function setOrder($id, Request $request)
    {
        $menu = $this->repository->find($id);
        $result = $this->repository->setOrder($menu, $request->except('_token'));

        return app(RiCaResponseService::class)->apiResponse('success', $result);
    }
}

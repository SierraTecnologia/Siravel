<?php

namespace Siravel\Http\Controllers\Admin;

use Siravel;
use Illuminate\Http\Request;
use Siravel\Models\Widget;
use Siravel\Http\Requests\WidgetRequest;
use Muleta\Services\ValidationService;
use Siravel\Repositories\WidgetRepository;
use theme;

class WidgetsController extends Controller
{
    public function __construct(WidgetRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Widgets.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $result = $this->repository->paginated();

        return view('admin.features.widgets.index')
            ->with('widgets', $result)
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

        return view('admin.features.widgets.index')
            ->with('widgets', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Widgets.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return view('admin.features.widgets.create');
    }

    /**
     * Store a newly created Widgets in storage.
     *
     * @param WidgetRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = app(ValidationService::class)->check(app(Widget::class)->rules);

        if (!$validation['errors']) {
            $widgets = $this->repository->store($request->all());
        } else {
            return $validation['redirect'];
        }

        Siravel::notification('Widgets saved successfully.', 'success');

        return redirect(route('admin.widgets.edit', [$widgets->id]));
    }

    /**
     * Show the form for editing the specified Widgets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $widget = $this->repository->find($id);

        if (empty($widget)) {
            Siravel::notification('Widgets not found', 'warning');

            return redirect(route('admin.widgets.index'));
        }

        return view('admin.features.widgets.edit')->with('widget', $widget);
    }

    /**
     * Update the specified Widgets in storage.
     *
     * @param int           $id
     * @param WidgetRequest $request
     *
     * @return Response
     */
    public function update($id, WidgetRequest $request)
    {
        $widgets = $this->repository->find($id);

        if (empty($widgets)) {
            Siravel::notification('Widgets not found', 'warning');

            return redirect(route('admin.widgets.index'));
        }

        $widgets = $this->repository->update($widgets, $request->all());

        Siravel::notification('Widgets updated successfully.', 'success');

        return redirect(url()->previous());
    }

    /**
     * Remove the specified Widgets from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $widgets = $this->repository->find($id);

        if (empty($widgets)) {
            Siravel::notification('Widgets not found', 'warning');

            return redirect(route('admin.widgets.index'));
        }

        $widgets->delete();

        Siravel::notification('Widgets deleted successfully.', 'success');

        return redirect(route('admin.widgets.index'));
    }
}

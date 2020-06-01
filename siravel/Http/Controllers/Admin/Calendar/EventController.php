<?php

namespace Siravel\Http\Controllers\Admin\Calendar;

use URL;
use Cms;
use Siravel\Models\Calendar\Event;
use Illuminate\Http\Request;
use Siravel\Http\Requests\EventRequest;
use Siravel\Services\ValidationService;
use Siravel\Repositories\EventRepository;
use Siravel\Http\Controllers\Admin\Controller as BaseController;

class EventController extends BaseController
{
    public function __construct(EventRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Event.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->repository->paginated();

        return view('admin.features.calendar.events.index')
            ->with('events', $result)
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

        return view('admin.features.calendar.events.index')
            ->with('events', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Event.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.features.calendar.events.create');
    }

    /**
     * Store a newly created Event in storage.
     *
     * @param EventRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = app(ValidationService::class)->check(Event::$rules);

        if (!$validation['errors']) {
            $event = $this->repository->store($request->all());
            Cms::notification('Event saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$event) {
            Cms::notification('Event could not be saved.', 'warning');
        }

        return redirect(route('admin.events.edit', [$event->id]));
    }

    /**
     * Show the form for editing the specified Event.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $event = $this->repository->find($id);

        if (empty($event)) {
            Cms::notification('Event not found', 'warning');

            return redirect(route('admin.events.index'));
        }

        return view('admin.features.calendar.events.edit')->with('event', $event);
    }

    /**
     * Update the specified Event in storage.
     *
     * @param int          $id
     * @param EventRequest $request
     *
     * @return Response
     */
    public function update($id, EventRequest $request)
    {
        $event = $this->repository->find($id);

        if (empty($event)) {
            Cms::notification('Event not found', 'warning');

            return redirect(route('admin.events.index'));
        }

        $event = $this->repository->update($event, $request->all());
        Cms::notification('Event updated successfully.', 'success');

        if (!$event) {
            Cms::notification('Event could not be saved.', 'warning');
        }

        return redirect(URL::previous());
    }

    /**
     * Remove the specified Event from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $event = $this->repository->find($id);

        if (empty($event)) {
            Cms::notification('Event not found', 'warning');

            return redirect(route('admin.events.index'));
        }

        $event->delete();

        Cms::notification('Event deleted successfully.', 'success');

        return redirect(route('admin.events.index'));
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
        $event = $this->repository->find($id);

        return view('admin.features.calendar.events.history')
            ->with('event', $event);
    }
}
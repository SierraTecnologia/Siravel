<?php

namespace Siravel\Http\Controllers\Admin\Calendar;

use URL;
use Siravel;
use Casa\Models\Calendar\Event;
use Illuminate\Http\Request;
use Siravel\Http\Requests\EventRequest;
use Muleta\Services\ValidationService;
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
    public function index(Request $request)
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
    public function create(Request $request)
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
        $validation = app(ValidationService::class)->check(app(Event::class)->rules);

        if (!$validation['errors']) {
            $event = $this->repository->store($request->all());
            Siravel::notification('Event saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$event) {
            Siravel::notification('Event could not be saved.', 'warning');
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
    public function edit(Request $request, $id)
    {
        $event = $this->repository->find($id);

        if (empty($event)) {
            Siravel::notification('Event not found', 'warning');

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
            Siravel::notification('Event not found', 'warning');

            return redirect(route('admin.events.index'));
        }

        $event = $this->repository->update($event, $request->all());
        Siravel::notification('Event updated successfully.', 'success');

        if (!$event) {
            Siravel::notification('Event could not be saved.', 'warning');
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
    public function destroy(Request $request, $id)
    {
        $event = $this->repository->find($id);

        if (empty($event)) {
            Siravel::notification('Event not found', 'warning');

            return redirect(route('admin.events.index'));
        }

        $event->delete();

        Siravel::notification('Event deleted successfully.', 'success');

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

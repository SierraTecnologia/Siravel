<?php

namespace Siravel\Http\Controllers\Admin\Interaction;

use Siravel\Http\Controllers\Controller;
use App\Services\ContactService;
use App\Repositories\ContactRepository;
use Siravel\Http\Controllers\Admin\Controller as BaseController;

class ContactController extends BaseController
{
    private $contactsRepository;

    public function __construct(ContactRepository $contactsRepo, ContactService $contactService)
    {
        $this->contactsRepository = $contactsRepo;
        $this->contactService = $contactService;

        if (!in_array('contacts', config('cms.active-core-features'))) {
            return redirect('/')->send();
        }
    }

    /**
     * Calendar.
     *
     * @param string $date
     *
     * @return Response
     */
    public function calendar($date = null)
    {
        if (is_null($date)) {
            $date = date('Y-m-d');
        }

        $contacts = $this->contactService->calendar($date);
        $calendar = $this->contactService->generate($date);

        if (empty($calendar)) {
            abort(404);
        }

        return view('contacts.calendar')
            ->with('contacts', $contacts)
            ->with('calendar', $calendar);
    }

    /**
     * Display page list.
     *
     * @return Response
     */
    public function date($date)
    {
        $contacts = $this->contactsRepository->findContactsByDate($date);

        if (empty($contacts)) {
            abort(404);
        }

        return view('contacts.date')->with('contacts', $contacts);
    }

    /**
     * Display page list.
     *
     * @return Response
     */
    public function all()
    {
        $contacts = $this->contactsRepository->published();

        if (empty($contacts)) {
            abort(404);
        }

        return view('contacts.all')->with('contacts', $contacts);
    }

    /**
     * Display the specified Page.
     *
     * @param string $date
     *
     * @return Response
     */
    public function show($id)
    {
        $contact = $this->contactsRepository->findContactById($id);

        if (empty($contact)) {
            abort(404);
        }

        return view('contacts.'.$contact->template)->with('contact', $contact);
    }
}

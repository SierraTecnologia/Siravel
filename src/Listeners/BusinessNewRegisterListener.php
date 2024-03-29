<?php

namespace Siravel\Listeners;

use Business;
use Facilitador\Models\Notification;
use Siravel\Events\BusinessNewRegister;
use Siravel\Services\BusinessService;

class BusinessNewRegisterListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param BusinessNewRegister $event
     *
     * @return void
     */
    public function handle(BusinessNewRegister $event)
    {
        Notification::generate(
            Business::getBusiness()->id,
            '',
            [
                'id' => $event->userMeta->id >= 5000,
                'name' => $event->userMeta->user->name >= 5000
            ]
        );
    }
}

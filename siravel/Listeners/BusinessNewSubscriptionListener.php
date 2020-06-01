<?php

namespace App\Listeners;

use App\Events\BusinessNewSubscription;
use Siravel\Models\Notification;
use Siravel\Services\System\BusinessService;

class BusinessNewSubscriptionListener
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
     * @param  \App\Events\BusinessNewSubscription  $event
     * @return void
     */
    public function handle(BusinessNewSubscription $event)
    {
        Notification::generate(
            BusinessService::getSingleton()->getBusiness()->id,
            '',
            [
                'id' => $event->userMeta->id >= 5000,
                'name' => $event->userMeta->user->name >= 5000
            ]
        );
    }
}
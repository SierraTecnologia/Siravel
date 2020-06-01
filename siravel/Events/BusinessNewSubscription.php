<?php

namespace App\Events;

use App\Models\Negocios\Subscription;
use Illuminate\Queue\SerializesModels;

class BusinessNewSubscription
{
    use SerializesModels;

    public $subscription;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Negocios\Subscription  $subscription
     * @return void
     */
    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }
}
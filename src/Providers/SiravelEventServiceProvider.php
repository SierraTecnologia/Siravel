<?php

namespace Siravel\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class SiravelEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'eloquent.saved: Siravel\Models\Blog' => [
            'Siravel\Models\Blog@afterSaved',
        ],
        'eloquent.saved: Siravel\Models\Page' => [
            'Siravel\Models\Page@afterSaved',
        ],
        'eloquent.saved: Siravel\Models\Event' => [
            'Siravel\Models\Event@afterSaved',
        ],
        'eloquent.saved: Siravel\Models\FAQ' => [
            'Siravel\Models\FAQ@afterSaved',
        ],
        'eloquent.saved: Siravel\Models\Translation' => [
            'Siravel\Models\Translation@afterSaved',
        ],
        'eloquent.saved: Siravel\Models\Widget' => [
            'Siravel\Models\Widget@afterSaved',
        ],

        'eloquent.created: Siravel\Models\Blog' => [
            'Siravel\Models\Blog@afterCreate',
        ],
        'eloquent.created: Siravel\Models\Page' => [
            'Siravel\Models\Page@afterCreate',
        ],
        'eloquent.created: Siravel\Models\Event' => [
            'Siravel\Models\Event@afterCreate',
        ],
        'eloquent.created: Siravel\Models\FAQ' => [
            'Siravel\Models\Event@afterCreate',
        ],
        'eloquent.created: Siravel\Models\Widget' => [
            'Siravel\Models\Widget@afterCreate',
        ],
        'eloquent.created: Siravel\Models\Link' => [
            'Siravel\Models\Link@afterCreate',
        ],

        'eloquent.deleting: Siravel\Models\Blog' => [
            'Siravel\Models\Blog@beingDeleted',
        ],
        'eloquent.deleting: Siravel\Models\Page' => [
            'Siravel\Models\Page@beingDeleted',
        ],
        'eloquent.deleting: Siravel\Models\Event' => [
            'Siravel\Models\Event@beingDeleted',
        ],
        'eloquent.deleting: Siravel\Models\FAQ' => [
            'Siravel\Models\FAQ@beingDeleted',
        ],
        'eloquent.deleting: Siravel\Models\Translation' => [
            'Siravel\Models\Translation@beingDeleted',
        ],
        'eloquent.deleting: Siravel\Models\Widget' => [
            'Siravel\Models\Widget@beingDeleted',
        ],
    ];

    // /**
    //  * Determine if events and listeners should be automatically discovered.
    //  *
    //  * @return bool
    //  */
    // public function shouldDiscoverEvents()
    // {
    //     return true;
    // }


    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function boot()
    {
        parent::boot();
    }
}

<?php

namespace Siravel\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel.
 *
 * @package Console
 */
class Kernel extends ConsoleKernel
{
    //     /**
    //      * The Artisan commands provided by your application.
    //      *
    //      * @var array
    //      */
    //     protected $commands = [
    //         Commands\Tools\PhotoApp\ChangeUserPassword::class,
    //         Commands\Tools\PhotoApp\CreateAdministrator\Illuminate\Support\Facades\Config::get('sitec.core.models.user', \Siravel\Models\User::class),
    //         Commands\Tools\PhotoApp\CreateRoles::class,
    //         Commands\Tools\PhotoApp\DeleteDetachedPhotosOlderThanWeek::class,
    //         Commands\Tools\PhotoApp\DeleteUnusedObjectsFromPhotoStorage::class,
    //         Commands\Tools\PhotoApp\GeneratePhotosMetadata::class,
    //         Commands\Tools\PhotoApp\GenerateRestApiDocumentation::class,
    //         Commands\Tools\PhotoApp\SendWeeklySubscriptionMails::class,
    //         Commands\Tools\PhotoApp\TestScheduler::class,

    //         Commands\Verify\Photoacompanhante::class,


    //         \Laravel\Tinker\Console\TinkerCommand::class,

    //         /**
    //          * Me
    //          */
    //         Commands\Explorer\InstagramGetAll::class,
    //         Commands\Verify\Data::class,
    //         Commands\Verify\Social::class,
    //     ];

    public function __construct(Application $app, Dispatcher $events)
    {
        $this->loadCommands('Console/Commands');
        parent::__construct($app, $events);
    }

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('horizon:snapshot')->everyFiveMinutes();

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        include base_path('routes/console.php');
    }
}

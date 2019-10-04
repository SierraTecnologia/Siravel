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
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\PhotoApp\ChangeUserPassword::class,
        Commands\PhotoApp\CreateAdministratorUser::class,
        Commands\PhotoApp\CreateRoles::class,
        Commands\PhotoApp\DeleteDetachedPhotosOlderThanWeek::class,
        Commands\PhotoApp\DeleteUnusedObjectsFromPhotoStorage::class,
        Commands\PhotoApp\GeneratePhotosMetadata::class,
        Commands\PhotoApp\GenerateRestApiDocumentation::class,
        Commands\PhotoApp\SendWeeklySubscriptionMails::class,
        Commands\PhotoApp\TestScheduler::class,

        Commands\Photoacompanhante::class,


        \Laravel\Tinker\Console\TinkerCommand::class,

        /**
         * Me
         */
        Commands\Explorer\InstagramGetAll::class,
        Commands\Import\Data::class,
        Commands\Import\Social::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('horizon:snapshot')->everyFiveMinutes();


        $schedule->command(Commands\PhotoApp\TestScheduler::class)
            ->hourly();

        $schedule->command(Commands\PhotoApp\DeleteDetachedPhotosOlderThanWeek::class)
            ->dailyAt('00:00')
            ->onOneServer();

        $schedule->command(Commands\PhotoApp\DeleteUnusedObjectsFromPhotoStorage::class)
            ->dailyAt('00:10')
            ->onOneServer();

        $schedule->command(Commands\PhotoApp\SendWeeklySubscriptionMails::class)
            ->weekly()
            ->sundays()
            ->at('06:00')
            ->onOneServer();


        $schedule->command('import:photoacompanhante')
        ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}

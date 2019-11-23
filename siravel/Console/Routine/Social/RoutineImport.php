<?php

namespace Siravel\Console\Routine\Social;

use Illuminate\Console\Command;
use Siravel\Models\MediaSend;
use Siravel\Models\MediaEmail;
use Siravel\Models\MediaPush;
use Siravel\Models\Company;
use App\Models\User;
use SendGrid;
use Siravel\Http\Controllers\Api\Controller;

class RoutineImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'routine:importAll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importar a porra toda !';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // (new \SiInteractions\Routines\Globals\BackupAll)->run();
        (new \SiInteractions\Routines\Globals\ImportTokens)->run();
    }
}

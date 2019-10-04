<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MediaSend;
use App\Models\MediaEmail;
use App\Models\MediaPush;
use App\Models\Company;
use App\Models\User;
use SendGrid;
use App\Http\Controllers\Api\Controller;

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
        // (new \App\Logic\Actions\Routines\Globals\BackupAll)->run();
        (new \App\Logic\Actions\Routines\Globals\ImportTokens)->run();
    }
}

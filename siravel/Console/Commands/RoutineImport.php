<?php

namespace Siravel\Console\Commands;

use Illuminate\Console\Command;
use Informate\Models\MediaSend;
use Informate\Models\MediaEmail;
use Informate\Models\MediaPush;
use Informate\Models\Company;
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
	 * Call fire function
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->fire();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        // (new \SiInteractions\Routines\Globals\BackupAll)->run();
        (new \SiInteractions\Routines\Globals\ImportTokens)->run();
    }
}

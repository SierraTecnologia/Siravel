<?php

namespace Siravel\Console\Commands;

use Illuminate\Console\Command;
use Siravel\Models\MediaSend;
use Siravel\Models\MediaEmail;
use Siravel\Models\MediaPush;
use Siravel\Models\Company;
use App\Models\User;
use SendGrid;
use Siravel\Http\Controllers\Api\Controller;

class SpiderDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spider:domain';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importar Dominio !';

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
        (new \SiInteractions\Routines\Globals\SpiderAllDomains)->run();
    }
}

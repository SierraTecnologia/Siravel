<?php

namespace Siravel\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use SiWeapons\Integrations\PhotoAcompanhante\Import;

class Photoacompanhante extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:photoacompanhante';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

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
        $this->comment(PHP_EOL.Inspiring::quote().PHP_EOL);

        (new Import())->slaves();
    }
}
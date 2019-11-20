<?php

namespace App\Console\Commands\Explorer;

use App\Actions\Instagram\GetMidias;
use App\Actions\Instagram\GetStories;
use App\Actions\Instagram\GetFollowers;
use Siravel\Models\Identity\Digital\Account;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Plugins\Integrations\PhotoAcompanhante\Import;

class InstagramGetAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'explorer:getall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->comment(PHP_EOL.Inspiring::quote().PHP_EOL);
        
        $account = Account::where('username', 'ricardorsierra')->first();

        (new GetMidias($account))->prepare('morizeflavia')->execute();
        // (new GetStories($account))->prepare('jean_grey380')->execute();
        // (new GetFollowers($account))->prepare('jean_grey380')->execute();
    }
}

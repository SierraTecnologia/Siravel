<?php

namespace App\Actions\Instagram;

use Illuminate\Support\Facades\Facade;

class GetStories extends Instagram
{
    public function execute()
    {
        collect($this->executor->getStories())->each(function ($story) {
            dd($story);
        });
    }
}

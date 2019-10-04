<?php
namespace App\Logic\Connections\Plugins\Pipelines;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use SiWeapons\Integrations\Instagram\Instagram;
use SiWeapons\Integrations\Instagram\Facebook;


use App\Logic\Connections\Plugins\Actions\PublishPost;
use App\Logic\Connections\Plugins\Actions\SearchFollows;



use App\Logic\Connections\Plugins\Routines\ForceNewRelations;
use App\Logic\Connections\Plugins\Routines\GetNewData;
use App\Logic\Connections\Plugins\Routines\SendNewData;

use App\Logic\Connections\Plugins\Components\Comment;
use App\Logic\Connections\Plugins\Components\Post;
use App\Logic\Connections\Plugins\Components\Profile;
use App\Logic\Connections\Plugins\Components\Relation;


class RegistratorLog
{
    public function register(Registrator $something)
    {
        echo 'registration log ' . $something . '<br>';
        return $something;
    }
}
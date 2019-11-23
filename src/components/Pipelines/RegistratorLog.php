<?php
namespace SiInteractions\Pipelines;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use SiWeapons\Integrations\Instagram\Instagram;
use SiWeapons\Integrations\Instagram\Facebook;


use SiInteractions\Actions\PublishPost;
use SiInteractions\Actions\SearchFollows;



use SiInteractions\Routines\ForceNewRelations;
use SiInteractions\Routines\GetNewData;
use SiInteractions\Routines\SendNewData;

use SiObjects\Components\Comment;
use SiObjects\Components\Post;
use SiObjects\Components\Profile;
use SiObjects\Components\Relation;


class RegistratorLog
{
    public function register(Registrator $something)
    {
        echo 'registration log ' . $something . '<br>';
        return $something;
    }
}
<?php
namespace SiInteractions\Pipelines;

use Log;
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

use App\Pipelines\Contracts\Registrator;
use App\Pipelines\Contracts\Notificator;

class NotificationEmail
{
    public function notification(Notificator $something)
    {
        echo 'notification ' . $something . '<br>';
        return $something;
    }
}
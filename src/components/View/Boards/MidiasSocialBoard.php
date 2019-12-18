<?php

namespace SiInteractions\View\Boards;

use Log;
use App\Models\User;
use SiWeapons\Integrations\Instagram\Instagram;
use SiWeapons\Integrations\Instagram\Facebook;


use SiInteractions\Actions\PublishPost;
use SiInteractions\Actions\SearchFollows;


use App\Editores\TuiImageEditor;



use SiInteractions\Routines\ForceNewRelations;
use SiInteractions\Routines\GetNewData;
use SiInteractions\Routines\SendNewData;

use App\Board;
use SiObjects\Components\Comment;
use SiObjects\Components\Post;
use SiObjects\Components\Profile;
use SiObjects\Components\Relation;

class MidiasSocialBoard extends Board
{
    
    public function getActions()
    {
        return [
            'Editor' => $this->getEditores(),
            'Save' => new GetNewData($this),
            'Delete' => new SendNewData($this),
            'Send' => $this->getIntegrations()
        ];
    }

    public function getComponents()
    {
        return [
            Post::class
        ];
    }

    /**
     * 
     */
    
    public function getEditores()
    {
        return [
            TuiImageEditor::class,
        ];
    }

}

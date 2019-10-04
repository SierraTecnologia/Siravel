<?php

namespace SiInteractions\View\Boards;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use SiWeapons\Integrations\Instagram\Instagram;
use SiWeapons\Integrations\Instagram\Facebook;


use SiInteraction\Actions\PublishPost;
use SiInteraction\Actions\SearchFollows;


use App\Editores\TuiImageEditor;



use SiInteraction\Routines\ForceNewRelations;
use SiInteraction\Routines\GetNewData;
use SiInteraction\Routines\SendNewData;

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

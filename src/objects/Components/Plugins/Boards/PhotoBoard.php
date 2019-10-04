<?php

namespace App\Logic\Connections\Plugins\Boards;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use SiWeapons\Integrations\Instagram\Instagram;
use SiWeapons\Integrations\Instagram\Facebook;


use App\Logic\Connections\Plugins\Actions\PublishPost;
use App\Logic\Connections\Plugins\Actions\SearchFollows;


use App\Logic\Connections\Plugins\Editores\TuiImageEditor;



use App\Logic\Connections\Plugins\Routines\ForceNewRelations;
use App\Logic\Connections\Plugins\Routines\GetNewData;
use App\Logic\Connections\Plugins\Routines\SendNewData;

use App\Logic\Connections\Plugins\Board;
use App\Logic\Connections\Plugins\Components\Comment;
use App\Logic\Connections\Plugins\Components\Post;
use App\Logic\Connections\Plugins\Components\Profile;
use App\Logic\Connections\Plugins\Components\Relation;

class PhotoBoard extends Board
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

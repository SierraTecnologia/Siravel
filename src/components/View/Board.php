<?php

namespace SiInteractions\View;

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

class Board
{
    
    public function executeRoutines()
    {
        new ForceNewRelations($this);
        new GetNewData($this);
        new SendNewData($this);
    }
    
    /**
     * CLasses Modulos
     */
    public function getIntegrations()
    {
        return [
            new Instagram(),
            new Facebook()
        ];
    }
    
    public function getActions()
    {
        return [
            SearchFollows::class,
            PublishPost::class,
        ];
    }

    public function getComponents()
    {
        return [
            Profile::class,
            [
                Relation::class,
                Post::class,
                [
                    Comment::class,
                ]
            ],
        ];
    }

    /**
     * 
     */
    
    public function getComponentsForFather()
    {
        return [
            SearchFollows::class,
            PublishPost::class,
        ];
    }

    
    /**
     * CLasses Operações
     */
    public function executeForEachIntegration($functionToExecute)
    {
        $integrations = $this->getIntegrations();
        foreach ( $integrations as $integration ) {
            $functionToExecute($integration);
        }
        return true;
    }

    public function executeForEachComponent($functionToExecute, $parent = false)
    {
        $self = $this;
        $components = $this->getComponentsForFather($parent);
        foreach ( $components as $component ) {
            $functionToExecute(
                $component,
                function ($result) use ($self, $functionToExecute) {
                    $self->executeForEachComponent($functionToExecute, $result);
                }
            );
        }
        return true;
    }

}

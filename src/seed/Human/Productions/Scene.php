<?php

namespace App\Logic\Info\Productions;

class Scene
{

    public function __construct()
    {
        
    }

    public static function components()
    {
        return [
            Actor::class,
            Scene::class, // Cena Anterior que essa cena depende
        ];
    }

    public static function forEachActor($actor)
    {
        return [
            Equipament::class
        ];
    }

    
}
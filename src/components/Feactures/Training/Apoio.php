<?php

namespace SiInteractions\Feactures\Training;

class Apoio
{

    public function plataforms()
    {
        return [
            SiWeapons\Integrations\Coursera\Coursera::class,
            SiWeapons\Integrations\Youtube\Youtube::class,
        ];
    }

    public function create()
    {
        return [
            
        ];
    }

    
}
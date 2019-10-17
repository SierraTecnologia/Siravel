<?php

namespace SiPlugins\ProjectManager;

use SiPlugins\SiPlugins as Base;
use SiWeapons\Manipuladores\Locations\Folder;

class ProjectManager extends Base
{
    public function __construct(Folder $folder)
    {
        $this->locationFolder = $folder;

        parent::__construct();
    }

    protected function mount()
    {
        return [
            'info' => $this->mountInfo(),
            'docs' => $this->mountDocs(),
        ];
    }

    protected function mountInfo()
    {
        $dependences = $this->getInfo()->extractorDependences();
        return [
            'name' => $dependences[0],
            'version' => $dependences[1],
        ];
    }

    protected function mountDocs()
    {
        return [
            'name' => $this->getInfo()->getName(),
            'version' => $this->getInfo()->getName(),
        ];
    }

    protected function getInfo()
    {
        if (!$this->getInfoInstance) {
            $this->getInfoInstance = new GetInfo($this);
        }
        return $this->getInfoInstance;
    }
    
}
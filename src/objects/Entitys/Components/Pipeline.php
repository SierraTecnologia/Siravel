<?php

namespace SiObjects\Logic\Entitys\Components;

use App\Logic\Actions\Pipelines\Contracts\Registrator;
use App\Logic\Actions\Pipelines\Contracts\Notificator;

/**
 * Class Pipeline
 * @package App\Logic\Entitys\Components
 */
class Pipeline
{
    
    public function __toString()
    {
        return (string) 'To String Pipeline';
    }

    /**
     * @var null|string
     */
    protected $result = null;
    /**
     * @return null
     */
    public function getResult()
    {
        return $this->result;
    }
    /**
     * @param string $result
     * @return static
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }
    /**
     * @param $result
     * @return $this
     */
    public function addResult($result)
    {
        $this->result .= $result;
        return $this;
    }
}
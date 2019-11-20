<?php

namespace SiObject\Mount\BigData;

use SiObject\Mount\BigData\Contracts\Output as OutputContract;
use SiObject\Mount\BigData\Contracts\Item as ItemContract;

/**
 * Class BigDataOutput.
 *
 * @package SiObject\Mount\BigData
 */
class Output implements OutputContract
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * @inheritdoc
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @inheritdoc
     */
    public function setItems(array $items)
    {
        $this->items = array_map(function (ItemContract $item) {
            return $item;
        }, $items);

        return $this;
    }
}

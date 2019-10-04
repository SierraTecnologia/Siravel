<?php

namespace SiObject\Mount\SiteMap;

use SiObject\Mount\SiteMap\Contracts\Builder as BuilderContract;
use SiObject\Mount\SiteMap\Contracts\Item as ItemContract;

/**
 * Class SiteMapBuilder.
 *
 * @package SiObject\Mount\SiteMap
 */
class Builder implements BuilderContract
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

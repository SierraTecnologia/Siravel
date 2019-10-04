<?php

namespace SiObject\Mount\Rss;

use SiObject\Mount\Rss\Contracts\Builder as BuilderContract;
use SiObject\Mount\Rss\Contracts\Channel;
use SiObject\Mount\Rss\Contracts\Item as ItemContract;

/**
 * Class Builder.
 *
 * @package SiObject\Mount\Rss
 */
class Builder implements BuilderContract
{
    /**
     * @var Channel
     */
    protected $channel;

    /**
     * @var array
     */
    protected $items;

    /**
     * @inheritdoc
     */
    public function getChannel(): Channel
    {
        return $this->channel;
    }

    /**
     * @inheritdoc
     */
    public function setChannel(Channel $channel)
    {
        $this->channel = $channel;

        return $this;
    }

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

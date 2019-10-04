<?php

namespace SiObject\Mount\Rss;

use SiObject\Mount\Rss\Contracts\Category as CategoryContract;

/**
 * Class Category.
 *
 * @package SiObject\Mount\Rss
 */
class Category implements CategoryContract
{
    /**
     * @var string
     */
    protected $value = '';

    /**
     * @inheritdoc
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @inheritdoc
     */
    public function setValue(string $value)
    {
        $this->value = $value;

        return $this;
    }
}

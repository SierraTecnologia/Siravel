<?php

namespace SiObject\Mount\Rss\Contracts;

/**
 * Interface Category.
 *
 * @package SiObject\Mount\Rss\Contracts
 */
interface Category
{
    /**
     * @return string
     */
    public function getValue(): string;

    /**
     * @param string $value
     * @return $this
     */
    public function setValue(string $value);
}

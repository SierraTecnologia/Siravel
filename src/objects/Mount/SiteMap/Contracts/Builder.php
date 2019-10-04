<?php

namespace SiObject\Mount\SiteMap\Contracts;

/**
 * Interface Builder.
 *
 * @package SiObject\Mount\SiteMap\Contracts
 */
interface Builder
{
    /**
     * @return array
     */
    public function getItems(): array;

    /**
     * @param array $items
     * @return $this
     */
    public function setItems(array $items);
}

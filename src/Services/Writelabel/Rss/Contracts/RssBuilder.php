<?php

namespace Siravel\Services\Rss\Contracts;

use SiObjects\Mount\Rss\Contracts\Builder;

/**
 * Interface RssBuilder.
 *
 * @package Siravel\Services\Rss\Contracts
 */
interface RssBuilder
{
    /**
     * Build the RSS feed.
     *
     * @return Builder
     */
    public function build(): Builder;
}

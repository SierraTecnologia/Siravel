<?php

namespace App\Services\Rss\Contracts;

use SiObject\Mount\Rss\Contracts\Builder;

/**
 * Interface RssBuilder.
 *
 * @package App\Services\Rss\Contracts
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

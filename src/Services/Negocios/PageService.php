<?php

namespace Siravel\Services\Negocios;

use Siravel\Repositories\Negocios\PageRepository;
use Siravel\Services\BaseService;
use Illuminate\Support\Facades\Config;

class PageService extends BaseService
{
    public function __construct()
    {
        $this->repo = app(PageRepository::class);
    }

    public function hasPage(string $page): bool
    {
        return !empty($this->repo->findPagesByURL($page));
    }

    /**
     * Get pages as options
     *
     * @return array
     */
    public function getPagesAsOptions()
    {
        $pages = [];
        $publishedPages = $this->repo->all();

        foreach ($publishedPages as $page) {
            $pages[$page->title] = $page->id;
        }

        return $pages;
    }

    /**
     * Get templates as options
     *
     * @return array
     */
    public function getTemplatesAsOptions()
    {
        return $this->getTemplatesAsOptionsArray('pages');
    }

    /**
     * Get a page name by ID
     *
     * @param int $id
     *
     * @return string
     */
    public function pageName($id)
    {
        $page = $this->repo->find($id);

        return $page->title;
    }
}

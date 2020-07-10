<?php

namespace Siravel\Repositories\Negocios;

use Carbon\Carbon;
use Siravel\Repositories\CmsRepository;
use Translation\Repositories\ModelTranslationRepository;
use Stalker\Services\Midia\FileService;

use Cms;
use Config;
use Crypto;
use Siravel\Models\Negocios\Page;
use Illuminate\Support\Facades\Schema;
use Siravel\Repositories\CmsRepository as BaseRepository;


class PageRepository extends BaseRepository
{
    public $model;

    public $translationRepo;

    public $table;

    public function __construct(Page $model, ModelTranslationRepository $translationRepo)
    {
        $this->model = $model;
        $this->translationRepo = $translationRepo;
        $this->table = \Illuminate\Support\Facades\Config::get('cms.db-prefix').'pages';
    }

    /**
     * Stores Pages into database.
     *
     * @param array $input
     *
     * @return Pages
     */
    public function store($payload)
    {
        $payload = $this->parseBlocks($payload, 'pages');

        $payload['title'] = htmlentities($payload['title']);
        $payload['url'] = Siravel::convertToURL($payload['url']);
        $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
        $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(\Illuminate\Support\Facades\Config::get('app.timezone'))->format('Y-m-d H:i:s');

        if (isset($payload['hero_image'])) {
            $file = request()->file('hero_image');
            $path = app(FileService::class)->saveFile($file, 'public/images', [], true);
            $payload['hero_image'] = $path['name'];
        }

        return $this->model->create($payload);
    }

    /**
     * Find Pages by given URL.
     *
     * @param string $url
     *
     * @return \Illuminate\Support\Collection|null|static|Pages
     */
    public function findPagesByURL($url)
    {
        $page = null;

        $page = $this->model->where('url', $url)->where('is_published', 1)->where('published_at', '<=', Carbon::now(\Illuminate\Support\Facades\Config::get('app.timezone'))->format('Y-m-d H:i:s'))->first();

        if ($page && app()->getLocale() !== \Illuminate\Support\Facades\Config::get('cms.default-language')) {
            $page = $this->translationRepo->findByEntityId($page->id, 'Siravel\Models\Negocios\Page');
        }

        if (!$page) {
            $page = $this->translationRepo->findByUrl($url, 'Siravel\Models\Negocios\Page');
        }

        if ($url === 'home' && app()->getLocale() !== \Illuminate\Support\Facades\Config::get('cms.default-language')) {
            $page = $this->translationRepo->findByUrl($url, 'Siravel\Models\Negocios\Page');
        }

        return $page;
    }

    /**
     * Updates Pages into database.
     *
     * @param Pages $page
     * @param array $input
     *
     * @return Pages
     */
    public function update($page, $payload)
    {
        $payload = $this->parseBlocks($payload, 'pages');

        if (isset($payload['hero_image'])) {
            app(FileService::class)->delete($page->hero_image);
            $file = request()->file('hero_image');
            $path = app(FileService::class)->saveFile($file, 'public/images', [], true);
            $payload['hero_image'] = $path['name'];
        }

        $payload['title'] = htmlentities($payload['title']);

        if (!empty($payload['lang']) && $payload['lang'] !== \Illuminate\Support\Facades\Config::get('cms.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($page->id, 'Siravel\Models\Negocios\Page', $payload['lang'], $payload);
        } else {
            $payload['url'] = Siravel::convertToURL($payload['url']);
            $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
            $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(\Illuminate\Support\Facades\Config::get('app.timezone'))->format('Y-m-d H:i:s');

            unset($payload['lang']);

            return $page->update($payload);
        }
    }
}

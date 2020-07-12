<?php

namespace Siravel\Traits\Services;

use Siravel\Models\Negocios\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

use Siravel\Repositories\Negocios\PageRepository;
use Siravel\Repositories\Negocios\MenuRepository;
use Siravel\Repositories\Negocios\LinkRepository;

trait MenuServiceTrait
{
    /**
     * Siravel package Menus.
     *
     * @return string
     */
    public function packageMenus()
    {
        $packageViews = Config::get('Siravel.package-menus', []);

        foreach ($packageViews as $view) {
            include $view;
        }
    }

    /**
     * Get a view.
     *
     * @param string $slug
     * @param View   $view
     *
     * @return string
     */
    public function menu($slug, $view = null)
    {
        $menu = MenuRepository::getMenuBySLUG($slug)->first();

        if (!$menu) {
            return '';
        }
        
        $links = LinkRepository::getLinksByMenuID($menu->id);
        $response = '';
        $processedLinks = [];
        foreach ($links as $link) {
            if ($link->external) {
                $response .= "<a href=\"$link->external_url\">$link->name</a>";
                $processedLinks[] = "<a href=\"$link->external_url\">$link->name</a>";
            } else {
                $page = Page::find($link->page_id);
                if ($page) {
                    if (\Illuminate\Support\Facades\Config::get('app.locale') == \Illuminate\Support\Facades\Config::get('Siravel.default-language', $this->config('Siravel.default-language'))) {
                        $response .= '<a href="'.URL::to('page/'.$page->url)."\">$link->name</a>";
                        $processedLinks[] = '<a href="'.URL::to('page/'.$page->url)."\">$link->name</a>";
                    } elseif (\Illuminate\Support\Facades\Config::get('app.locale') != \Illuminate\Support\Facades\Config::get('Siravel.default-language', $this->config('Siravel.default-language'))) {
                        if ($page->translation(\Illuminate\Support\Facades\Config::get('app.locale'))) {
                            $response .= '<a href="'.URL::to('page/'.$page->translation(\Illuminate\Support\Facades\Config::get('app.locale'))->data->url)."\">$link->name</a>";
                            $processedLinks[] = '<a href="'.URL::to('page/'.$page->translation(\Illuminate\Support\Facades\Config::get('app.locale'))->data->url)."\">$link->name</a>";
                        }
                    }
                }
            }
        }

        /**
         * Features
         */
        foreach (\Illuminate\Support\Facades\Config::get('siravel.features', []) as $module => $config) {
            $link = $module;

            if (isset($config['url'])) {
                $link = $config['url'];
            }

            $response .= "<a href=\"url($link)\">ucfirst($link)</a>";
            $processedLinks[] = "<a href=\"url($link)\">ucfirst($link)</a>";
        }

        if (!is_null($view)) {
            $response = view($view, ['links' => $links, 'linksAsHtml' => $response, 'processed_links' => $processedLinks]);
        }

        if (Gate::allows('Siravel', Auth::user())) {
            $response .= '<a href="'.url('Siravel/menus/'.$menu->id.'/edit').'" style="margin-left: 8px;" class="btn btn-xs btn-default"><span class="fa fa-pencil"></span> Edit</a>';
        }

        return $response;
    }
}
<?php

if (!function_exists('menu')) {
    function menu($slug, $view = null)
    {
        return app('CmsService')->menu($slug, $view);
    }
}

if (!function_exists('theme')) {
    function theme($name)
    {
        return view($name);
    }
}

if (!function_exists('menu_lang')) {
    function menu_lang()
    {
        return app('CmsService')->menu_lang();
    }
}

if (!function_exists('img_lang')) {
    function img_lang($img_path)
    {
        return app('CmsService')->img_lang($img_path);
    }
}

if (!function_exists('images')) {
    function images($tag = null)
    {
        return app('CmsService')->images($tag);
    }
}

if (!function_exists('widget')) {
    function widget($slug)
    {
        return app('CmsService')->widget($slug);
    }
}

if (!function_exists('edit')) {
    function edit($module, $id = null)
    {
        return app('CmsService')->module($module, $id);
    }
}

if (!function_exists('editBtn')) {
    function editBtn($module, $id = null)
    {
        return app('CmsService')->module($module, $id);
    }
}

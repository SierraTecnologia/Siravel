<?php

namespace Siravel\Http\Controllers\Admin;

use Siravel\Services\System\VersionService;

class PageController extends Controller
{
    public function help()
    {
        return view('admin.pages.help');
    }

    public function changelog(VersionService $versionService)
    {
        $releases = $versionService->getReleases();
        return view('admin.pages.releases', compact('releases'));
    }
}

<?php

namespace Siravel\Http\Controllers\Features\Writelabel;

use Illuminate\Http\Request;
use Siravel\Repositories\Negocios\PageRepository;
use Siravel;

class PagesController extends Controller
{
    protected $repository;

    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Homepage.
     *
     * @param string $url
     *
     * @return Response
     */
    public function home()
    {
        Siravel::notification('Ola');
        $page = $this->repository->findPagesByURL('home');

        $view = view('features.writelabel.pages.home');

        if (is_null($page)) {
            return $view;
        }

        return $view->with('page', $page);
    }

    /**
     * Display page list.
     *
     * @return Response
     */
    public function all()
    {
        $pages = $this->repository->published();

        if (empty($pages)) {
            abort(404);
        }

        return view('features.writelabel.pages.all')->with('pages', $pages);
    }

    /**
     * Display the specified Page.
     *
     * @param string $url
     *
     * @return Response
     */
    public function show($url)
    {
        $page = $this->repository->findPagesByURL($url);

        if (empty($page)) {
            abort(404);
        }

        $template = $page->template;
        if (empty($page->template)) {
            $template = 'home';
        }

        return view('features.writelabel.pages.'.$template)->with('page', $page);
    }
}

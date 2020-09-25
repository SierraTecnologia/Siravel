<?php

namespace Siravel\Http\Controllers\Admin\Blog;

use Siravel;
use Siravel\Models\Blog\Blog;
use Illuminate\Http\Request;
use Siravel\Http\Requests\BlogRequest;
use Muleta\Services\ValidationService;
use Siravel\Repositories\BlogRepository;
use Siravel\Http\Controllers\Admin\Controller as BaseController;

class BlogController extends BaseController
{
    public function __construct(BlogRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Blog.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $blogs = $this->repository->paginated();

        return view('admin.features.blogs.blogs.index')
            ->with('blogs', $blogs)
            ->with('pagination', $blogs->render());
    }

    public function all()
    {
        return $this->index();
    }

    /**
     * Search.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request)
    {
        $input = $request->all();

        $result = $this->repository->search($input);

        return view('admin.features.blogs.blogs.index')
            ->with('blogs', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Blog.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.features.blogs.blogs.create');
    }

    /**
     * Store a newly created Blog in storage.
     *
     * @param BlogRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = app(ValidationService::class)->check(Blog::$rules);

        if (!$validation['errors']) {
            $blog = $this->repository->store($request->all());
            Siravel::notification('Blog saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$blog) {
            Siravel::notification('Blog could not be saved.', 'warning');
        }

        return redirect(route('admin.blog.edit', [$blog->id]));
    }

    /**
     * Show the form for editing the specified Blog.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $blog = $this->repository->find($id);

        if (empty($blog)) {
            Siravel::notification('Blog not found', 'warning');

            return redirect(route('admin.blog.index'));
        }

        return view('admin.features.blogs.blogs.edit')->with('blog', $blog);
    }

    /**
     * Update the specified Blog in storage.
     *
     * @param int         $id
     * @param BlogRequest $request
     *
     * @return Response
     */
    public function update($id, BlogRequest $request)
    {
        $blog = $this->repository->find($id);

        if (empty($blog)) {
            Siravel::notification('Blog not found', 'warning');

            return redirect(route('admin.blog.index'));
        }

        $validation = app(ValidationService::class)->check(Blog::$rules);

        if (!$validation['errors']) {
            $blog = $this->repository->update($blog, $request->all());

            Siravel::notification('Blog updated successfully.', 'success');

            if (! $blog) {
                Siravel::notification('Blog could not be saved.', 'warning');
            }
        } else {
            return $validation['redirect'];
        }

        return back();
    }

    /**
     * Remove the specified Blog from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $blog = $this->repository->find($id);

        if (empty($blog)) {
            Siravel::notification('Blog not found', 'warning');

            return redirect(route('admin.blog.index'));
        }

        $blog->delete();

        Siravel::notification('Blog deleted successfully.', 'success');

        return redirect(route('admin.blog.index'));
    }

    /**
     * Blog history.
     *
     * @param int $id
     *
     * @return Response
     */
    public function history($id)
    {
        $blog = $this->repository->find($id);

        return view('admin.features.blogs.blogs.history')
            ->with('blog', $blog);
    }
}

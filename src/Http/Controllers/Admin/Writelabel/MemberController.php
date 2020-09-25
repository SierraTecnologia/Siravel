<?php

namespace Siravel\Http\Controllers\Admin\Writelabel;

use Siravel;
use Exception;
use Siravel\Models\Negocios\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Siravel\Http\Requests\MemberRequest;
use Muleta\Services\ValidationService;
use Siravel\Http\Controllers\Admin\Controller as BaseController;
use Siravel\Repositories\Negocios\MemberRepository;

class MemberController extends BaseController
{
    public function __construct(MemberRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Member.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $result = $this->repository->paginated();

        return view('admin.features.writelabel.members.index')
            ->with('members', $result)
            ->with('pagination', $result->render());
    }

}

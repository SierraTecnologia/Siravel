<?php

namespace Siravel\Http\Controllers\Admin\Interaction;

use Siravel;
use Illuminate\Http\Request;
use Siravel\Models\Promotion;
use Siravel\Http\Requests\PromotionRequest;
use Facilitador\Services\ValidationService;
use Siravel\Repositories\PromotionRepository;
use Siravel\Http\Controllers\Admin\Controller as BaseController;

class PromotionsController extends BaseController
{
    public function __construct(PromotionRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Promotions.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->repository->paginated();

        return view('admin.features.writelabel.promotions.index')
            ->with('promotions', $result)
            ->with('pagination', $result->render());
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

        return view('admin.features.writelabel.promotions.index')
            ->with('promotion', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Promotions.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.features.writelabel.promotions.create');
    }

    /**
     * Store a newly created Promotions in storage.
     *
     * @param PromotionRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = app(ValidationService::class)->check(Promotion::$rules);

        if (!$validation['errors']) {
            $promotion = $this->repository->store($request->all());
        } else {
            return $validation['redirect'];
        }

        Siravel::notification('Promotions saved successfully.', 'success');

        return redirect(route('admin.promotions.edit', [$promotion->id]));
    }

    /**
     * Show the form for editing the specified Promotions.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $promotion = $this->repository->find($id);

        if (empty($promotion)) {
            Siravel::notification('Promotions not found', 'warning');

            return redirect(route('admin.promotions.index'));
        }

        return view('admin.features.writelabel.promotions.edit')->with('promotion', $promotion);
    }

    /**
     * Update the specified Promotions in storage.
     *
     * @param int            $id
     * @param PromotionRequest $request
     *
     * @return Response
     */
    public function update($id, PromotionRequest $request)
    {
        $promotion = $this->repository->find($id);

        if (empty($promotion)) {
            Siravel::notification('Promotions not found', 'warning');

            return redirect(route('admin.promotions.index'));
        }

        $promotion = $this->repository->update($promotion, $request->all());

        Siravel::notification('Promotions updated successfully.', 'success');

        return redirect(url()->previous());
    }

    /**
     * Remove the specified Promotions from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $promotion = $this->repository->find($id);

        if (empty($promotion)) {
            Siravel::notification('Promotions not found', 'warning');

            return redirect(route('admin.promotions.index'));
        }

        $promotion->delete();

        Siravel::notification('Promotions deleted successfully.', 'success');

        return redirect(route('admin.promotions.index'));
    }
}

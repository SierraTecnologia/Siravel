<?php

namespace Siravel\Http\Controllers\Admin\Commerce;

use Illuminate\Http\Request;
use Siravel\Http\Controllers\Controller;
use Siravel\Services\Commerce\PlanService;
use Siravel\Http\Requests\Commerce\PlanRequest;

class PlanController extends Controller
{
    public function __construct(PlanService $planService)
    {
        $this->service = $planService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->service->collectNewPlans();
        $plans = $this->service->paginated();

        return view('siravel::admin.features.commerce.plans.index')->with('plans', $plans);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $plans = $this->service->search($request->term);

        return view('siravel::admin.features.commerce.plans.index')
            ->with('term', $request->term)
            ->with('plans', $plans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        return view('siravel::admin.features.commerce.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PlanRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return redirect(config('siravel.backend-route-prefix', 'siravel').'/plans/'.$result->id.'/edit')->with('success', 'Successfully created');
        }

        return redirect('admin.commerce.plans')->with('error', 'Failed to create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $plan = $this->service->find($id);
        $customers = $this->service->getSubscribers($plan);

        return view('siravel::admin.features.commerce.plans.edit')
            ->with('customers', $customers)
            ->with('plan', $plan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int                          $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id): self
    {
        $result = $this->service->update($id, $request->except('_token', '_method'));

        if ($result) {
            return back()->with('success', 'Successfully updated');
        }

        return back()->with('error', 'Failed to update');
    }

    /**
     * Disable a plan.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function stateChange(Request $request, $id): self
    {
        $result = $this->service->stateChange($id, $request->state);

        if ($result) {
            return back()->with('success', 'Successfully updated');
        }

        return back()->with('error', 'Failed to update');
    }

    /**
     * Cancel a subscription.
     *
     * @param int $plan
     * @param int $userMeta
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelSubscription($plan, $userMeta): self
    {
        $result = $this->service->cancelSubscription($plan, $userMeta);

        if ($result) {
            return back()->with('success', 'Successfully cancelled');
        }

        return back()->with('error', 'Failed to cancel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(config('siravel.backend-route-prefix', 'siravel').'/plans')->with('success', 'Successfully deleted');
        }

        return redirect(config('siravel.backend-route-prefix', 'siravel').'/plans')->with('error', 'Failed to delete');
    }
}

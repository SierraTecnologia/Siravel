<?php

namespace Siravel\Http\Controllers\Admin\Commerce;

use Siravel\Http\Controllers\SitecController;
use Siravel\Http\Requests\Commerce\CouponRequest;
use Siravel\Http\Requests\Commerce\PlanRequest;
use Siravel\Services\Commerce\CouponService;
use Illuminate\Http\Request;

class CouponController extends SitecController
{
    public function __construct(CouponService $couponService)
    {
        $this->service = $couponService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->service->collectNewCoupons();
        $coupons = $this->service->paginated();

        return view('admin.features.commerce.coupons.index')->with('coupons', $coupons);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $coupons = $this->service->search($request->term);

        return view('admin.features.commerce.coupons.index')
            ->with('term', $request->term)
            ->with('coupons', $coupons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.features.commerce.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\CouponRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return redirect(config('cms.backend-route-prefix', 'cms').'/coupons/'.$result->id)
                ->with('success', 'Successfully created');
        }

        return redirect('admin.commerce.coupons')->with('error', 'Failed to create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupon = $this->service->find($id);

        return view('admin.features.commerce.coupons.show')
            ->with('coupon', $coupon);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(config('cms.backend-route-prefix', 'cms').'/coupons')
                ->with('success', 'Successfully deleted');
        }

        return redirect(config('cms.backend-route-prefix', 'cms').'/coupons')
            ->with('error', 'Failed to delete');
    }
}

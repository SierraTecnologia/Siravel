<?php

namespace Siravel\Http\Controllers\Features\Commerce;

use Illuminate\Http\Request;
use Siravel\Http\Controllers\Features\Controller;
use Siravel\Services\Commerce\CustomerProfileService;

class ProfileController extends Controller
{
    public function __construct(CustomerProfileService $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Display the customer profile.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function customerProfile()
    {
        return view('features.commerce.profile.details');
    }

    /**
     * Update Customer profile.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function customerProfileUpdate(Request $request): self
    {
        $this->customer->updateProfileAddress($request->except('_token'));

        return back()->with('message', 'Successfully updated');
    }

    /**
     * Add a coupon form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addCoupon(Request $request)
    {
        return view('features.commerce.profile.coupon');
    }

    /**
     * Add coupon to profile.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitCoupon(Request $request): self
    {
        try {
            auth()->user()->meta->applyCoupon($request->coupon);
            $message = 'Successfully added coupon.';
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        return back()->with('message', $message);
    }
}

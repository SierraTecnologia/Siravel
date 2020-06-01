<?php

namespace Siravel\Http\Controllers\Features\Commerce;

use Exception;
use Illuminate\Http\Request;
use Siravel\Http\Controllers\Controller;
use Siravel\Services\Commerce\CartService;
use Siravel\Services\Commerce\PaymentService;
use Siravel\Services\Commerce\CustomerProfileService;

class CheckoutController extends Controller
{
    public function __construct(
        CartService $cartService,
        PaymentService $paymentService,
        CustomerProfileService $customer
    ) {
        $this->cart = $cartService;
        $this->payment = $paymentService;
        $this->customer = $customer;
    }

    /**
     * Show the customer confirmation page
     *
     * @return Illuminate\Http\Response
     */
    public function confirm()
    {
        $products = $this->cart->contents();

        return view('features.commerce.checkout.confirm')->with('products', $products);
    }

    /**
     * Confirm payment view
     *
     * @return Illuminate\Http\Response
     */
    public function payment()
    {
        $products = $this->cart->contents();

        return view('features.commerce.checkout.payment')->with('products', $products);
    }

    /**
     * Add a coupon to the cart
     *
     * @param Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function addCoupon(Request $request)
    {
        $this->cart->addCoupon($request->coupon);

        return back()->with('message', 'Successfully applied coupon');
    }

    /**
     * Remove a coupon from the cart
     *
     * @return Illuminate\Http\Response
     */
    public function removeCoupon()
    {
        $this->cart->removeCoupon();

        return back()->with('message', 'Successfully removed coupon');
    }

    /**
     * Process a payment
     *
     * @param Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        try {
            $response = $this->payment->purchase($request->input('sitecpaymentToken'), $this->cart);
        } catch (Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }

    /**
     * Process a payment with the last card on file
     *
     * @param Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function processWithLastCard(Request $request)
    {
        try {
            $response = $this->payment->purchase($request->input('sitecpaymentToken'), $this->cart);
        } catch (Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }

    /**
     * Purchase is completed view
     *
     * @return Illuminate\Http\Response
     */
    public function complete()
    {
        $products = $this->cart->contents();

        return view('features.commerce.checkout.complete')->with('products', $products);
    }

    /**
     * Purchase failed view
     *
     * @return Illuminate\Http\Response
     */
    public function failed()
    {
        return view('features.commerce.checkout.failed');
    }

    /**
     * Recalculate shipping request
     *
     * @param Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function reCalculateShipping(Request $request)
    {
        $this->customer->updateProfileAddress(
            array_merge(
                $request->address, [
                'shipping' => true
                ]
            )
        );

        return back()->with('message', 'Successfully updated');
    }
}

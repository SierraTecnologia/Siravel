<?php

namespace Siravel\Services;

use Illuminate\Support\Facades\Log;
use Muleta\Interfaces\LogisticServiceInterface;
use Siravel\Services\Commerce\CustomerProfileService;
use Siravel\Services\Commerce\LogisticService;

class StoreLogistics implements LogisticServiceInterface
{
    public function __construct(
        CustomerProfileService $customerService,
        LogisticService $logistics
    ) {
        $this->customer = $customerService;
        $this->logistics = $logistics;
    }

    /**
     * Calculate the shipping cost.
     *
     * @param user $user
     *
     * @return int
     */
    public function shipping($user)
    {
        $address = $this->customer->shippingAddress();
        $weight = $this->logistics->cartWeight();

        return 0;
    }

    /**
     * Calculate an items shipping cost.
     *
     * @param user $user
     *
     * @return int
     */
    public function singleItemShipping($item, $user)
    {
        return 0;
    }

    /**
     * Calculate the Tax.
     *
     * @return int
     */
    public function getTaxPercent($user)
    {
        $address = $this->customer->billingAddress();

        return 0;
    }

    /*
    |--------------------------------------------------------------------------
    | Purchases & Refunds
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function afterPurchase($user, $transaction, $cart, $result)
    {
        Log::info('After purchase');

        if ($result) {
            $cart->emptyCart();

            return redirect('store/complete');
        } else {
            return redirect('store/failed');
        }
    }

    /**
     * @return true
     */
    public function afterSubscription($user, $plan)
    {
        // code...
        Log::info('After subscription');

        return true;
    }

    /**
     * @return true
     */
    public function afterRefundRequest($transaction)
    {
        // code...
        Log::info('After refund request');

        return true;
    }

    /**
     * @return true
     */
    public function afterRefund($transaction)
    {
        // code...
        Log::info('After refund');

        return true;
    }

    /**
     * @return true
     */
    public function cancelSubscription($user, $plan)
    {
        // code...
        Log::info('Cancel subscription');

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | Orders
    |--------------------------------------------------------------------------
    */

    /**
     * @return true
     */
    public function afterPlaceOrder($user, $transaction, $cart)
    {
        // places order into orders table
        Log::info('Order was placed');

        return true;
    }

    /**
     * @return true
     */
    public function orderCreated($order)
    {
        // sets order to shipped - and does any needed logic
        Log::info('Order was shipped');

        return true;
    }

    /**
     * @return true
     */
    public function shipOrder($order)
    {
        // sets order to shipped - and does any needed logic
        Log::info('Order was shipped');

        return true;
    }

    /**
     * @return true
     */
    public function cancelOrder($order)
    {
        // sets order to shipped - and does any needed logic
        Log::info('Order was cancelled');

        return true;
    }

    /**
     * @return true
     */
    public function afterItemCancelled($orderItem)
    {
        // sets order to shipped - and does any needed logic
        Log::info('Order item was cancelled');

        return true;
    }
}

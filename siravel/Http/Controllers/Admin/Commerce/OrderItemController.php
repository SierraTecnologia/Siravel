<?php

namespace App\Http\Controllers\Admin\Commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Commerce\OrderItemService;
use App\Services\Commerce\OrderService;

class OrderItemController extends Controller
{
    public function __construct(OrderItemService $orderItemService)
    {
        $this->service = $orderItemService;
    }

    /**
     * Show order item
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderItem = $this->service->find($id);

        return view('admin.features.commerce.orders.item')->with('orderItem', $orderItem);
    }

    /**
     * Cancel an order item
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function cancel(Request $request)
    {
        $result = $this->service->cancel($request->id);

        if ($result) {
            return back()->with('success', 'Successfully cancelled');
        }

        return back()->with('error', 'Failed to cancel');
    }
}

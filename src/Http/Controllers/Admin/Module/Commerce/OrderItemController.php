<?php

namespace Siravel\Http\Controllers\Admin\Commerce;

use Siravel\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Siravel\Services\Commerce\OrderItemService;
use Siravel\Services\Commerce\OrderService;

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
    public function show(Request $request, $id)
    {
        $orderItem = $this->service->find($id);

        return view('siravel::admin.features.commerce.orders.item')->with('orderItem', $orderItem);
    }

    /**
     * Cancel an order item
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Request $request): self
    {
        $result = $this->service->cancel($request->id);

        if ($result) {
            return back()->with('success', 'Successfully cancelled');
        }

        return back()->with('error', 'Failed to cancel');
    }
}

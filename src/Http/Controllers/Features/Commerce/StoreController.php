<?php

namespace Siravel\Http\Controllers\Features\Commerce;

use Siravel\Http\Controllers\Features\Controller;
use Market\Repositories\ProductRepository;
use Siravel\Services\Commerce\PlanService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $productsRepository;

    public function __construct(ProductRepository $productRepository, PlanService $planService)
    {
        $this->products = $productRepository;
        $this->plans = $planService;
    }

    /**
     * Display the store front.
     *
     * @param int $id
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $products = $this->products->getPublishedProducts()->paginate(25);
        $plans = $this->plans->allEnabled();

        if (empty($products)) {
            abort(404);
        }

        return view('features.commerce.storefront')
            ->with('plans', $plans)
            ->with('products', $products);
    }
}

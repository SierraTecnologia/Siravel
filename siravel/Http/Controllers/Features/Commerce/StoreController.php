<?php

namespace App\Http\Controllers\Features\Commerce;

use App\Http\Controllers\Controller;
use App\Repositories\Commerce\ProductRepository;
use App\Services\Commerce\PlanService;

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
    public function index()
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

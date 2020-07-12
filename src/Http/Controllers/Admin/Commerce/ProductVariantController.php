<?php

namespace Siravel\Http\Controllers\Admin\Commerce;

use Siravel;
use Response;
use Illuminate\Http\Request;
use Siravel\Models\Commerce\Products;
use Siravel\Http\Controllers\SitecController;
use Siravel\Repositories\Commerce\ProductRepository;
use Siravel\Repositories\Commerce\ProductVariantRepository;

class ProductVariantController extends SitecController
{
    /**
     * Product Repository.
     *
     * @var Siravel\Repositories\Commerce\ProductRepository
     */
    public $productRepository;

    /**
     * Product Variant Repository.
     *
     * @var Siravel\Repositories\Commerce\ProductVariantRepository
     */
    public $productVariantRepository;

    public function __construct(
        ProductVariantRepository $productVariantRepository,
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
    }

    /**
     * Get a product's variants.
     *
     * @param int                     $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function variants($id, Request $request)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Siravel::notification('Product not found', 'warning');

            return redirect(route('siravel.products.index'));
        }

        if ($this->productVariantRepository->addVariant($product, $request->all())) {
            Siravel::notification('Variant successfully added.', 'success');
        } else {
            Siravel::notification('Failed to add variant. Missing Key or Value.', 'warning');
        }

        return redirect(route(config('siravel.backend-route-prefix', 'siravel').'.products.edit', $id).'?tab=variants');
    }

    /**
     * Save a variant.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function saveVariant(Request $request)
    {
        $this->productVariantRepository->saveVariant($request->all());

        return Response::json(['success']);
    }

    /**
     * Delete a variant.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function deleteVariant(Request $request)
    {
        $this->productVariantRepository->deleteVariant($request->all());

        return Response::json(['success']);
    }
}

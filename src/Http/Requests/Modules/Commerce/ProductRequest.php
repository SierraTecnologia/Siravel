<?php

namespace Siravel\Http\Requests\Commerce;

use Siravel\Models\Commerce\Product;

class ProductRequest extends CommerceRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return app(Product::class)->rules;
    }
}

<?php

namespace Siravel\Models\Commerce;

use App\Models\CmsModel;
use Siravel\Models\Commerce\Product;

use Siravel\Models\Traits\BusinessTrait;

class Favorite extends CmsModel
{
    use BusinessTrait;
    
    public $table = 'favorites';

    public $primaryKey = 'id';

    public $timestamps = true;

    public $fillable = [
        'product_id',
        'user_id',
    ];

    /**
     * Get the corresponding Product
     *
     * @return Relationship
     */
    public function product()
    {
        return $this->hasOne(Product::class);
    }
}

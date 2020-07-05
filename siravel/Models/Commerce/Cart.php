<?php

namespace Siravel\Models\Commerce;

use App\Models\CmsModel;

use Siravel\Models\Traits\BusinessTrait;

class Cart extends CmsModel
{
    use BusinessTrait;
    
    public $table = 'cart';

    public $primaryKey = 'id';

    public $timestamps = true;

    public $fillable = [
        'user_id',
        'entity_id',
        'entity_type',
        'address',
        'product_variants',
        'quantity',
    ];

    public static $rules = [];
}

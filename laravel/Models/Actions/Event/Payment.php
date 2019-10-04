<?php
/**
 * Armazena os tipos de pagamentos que fazem com cada moeda e suas taxas
 */

namespace App\Models\Event;

use Illuminate\Support\Facades\Hash;

use App\Models\Model;
class Payment  extends Model
{


    public function createByType()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }
}
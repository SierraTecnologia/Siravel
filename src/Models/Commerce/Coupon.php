<?php

namespace Siravel\Models\Commerce;

use Carbon\Carbon;
use App\Models\CmsModel;
use App\Services\Commerce\CartService;

use Siravel\Models\Traits\BusinessTrait;

class Coupon extends CmsModel
{
    use BusinessTrait;
    
    public $table = 'coupons';

    public $primaryKey = 'id';

    public $timestamps = true;

    public $fillable = [
        'start_date',
        'end_date',
        'code',
        'currency',
        'discount_type',
        'for_subscriptions',
        'amount',
        'limit',
        'sitecpayment_id',
    ];

    public static $rules = [
        'amount' => 'required',
        'limit' => 'required',
        'discount_type' => 'required',
    ];

    public function getCouponsBySierraTecnologiaId($id)
    {
        return $this->where('sitecpayment_id', $id)->first();
    }

    public function expired()
    {
        $now = Carbon::now(config('app.timezone'));

        if (!is_null($this->end_date) && $now->gt(Carbon::parse($this->end_date))) {
            return true;
        }

        return false;
    }

    public function getDollarsAttribute()
    {
        return app(CartService::class)->getCurrentCouponValue($this->sitecpayment_id);
    }

    public function getValueAttribute()
    {
        if ($this->discount_type == 'dollar') {
            return round($this->amount / 100, 2);
        }

        return $this->amount;
    }

    public function getValueStringAttribute()
    {
        if ($this->discount_type == 'dollar') {
            return '$'.$this->value;
        }

        return $this->value.'%';
    }
}

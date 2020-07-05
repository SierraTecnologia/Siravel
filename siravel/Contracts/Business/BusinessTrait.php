<?php

namespace Siravel\Contracts\Business;

use Illuminate\Support\Facades\Log;
use Siravel\Models\Model;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Informate\Traits\EloquentGetTableNameTrait;

trait BusinessTrait
{
    use EloquentGetTableNameTrait;

    protected static function bootBusinessTrait()                                                                                                                                                             
    {
        if ($business = app(\Siravel\Services\System\BusinessService::class)->getBusiness()){

            static::creating(function ($model) use ($business) {
                $model->business_code = $business->code;
                if (Auth::check()) {
                    // @todo Verifica se tem acesso
                }
            });

            static::addGlobalScope('business', function (Builder $builder) use ($business) {
                $builder->where(self::getTableName().'.business_code', '=', $business->code);
            });

        }
    }
}

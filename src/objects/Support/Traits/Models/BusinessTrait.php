<?php

namespace SiObjects\Support\Traits\Models;

use Illuminate\Support\Facades\Log;
use App\Models\Model;
use Auth;
use Illuminate\Database\Eloquent\Builder;

trait BusinessTrait
{
    use EloquentGetTableNameTrait;

    protected static function bootBusinessTrait()                                                                                                                                                             
    {
        if ($business = \Siravel\Services\System\BusinessService::getSingleton()->getBusiness()){

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

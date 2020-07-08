<?php

namespace Siravel\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Siravel\Services\System\BusinessService;
use Illuminate\Support\Facades\Schema;

class BusinessScope implements Scope
{

    /**
    * Apply the scope to a given Eloquent query builder.
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $builder
    * @param  \Illuminate\Database\Eloquent\Model  $model
    * @return void
    */
    public function apply(Builder $builder, Model $model)
    {
        if (Schema::hasColumn($model->getTable(), 'business_code'))
        {
            $business = app(BusinessService::class);
            $builder->where('business_code',  $business->getCode());
            // if (Auth::check()) {
            //     // @todo Verifica se tem acesso
            // }
        }

        // // no luck here as well
        // $userId = auth()->user()->system_id;

        // /**
        //  * appended query constraint for this scope
        //  */
        // $builder->where('system_id', $userId);
    }


}

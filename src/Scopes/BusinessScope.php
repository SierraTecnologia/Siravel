<?php

namespace Siravel\Scopes;

use Business;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class BusinessScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model   $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        // dd(Business::isToApplyCodeBusiness($model));
        if (Business::isToApplyCodeBusiness($model)) {
            $builder->where('business_code', Business::getCode());
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

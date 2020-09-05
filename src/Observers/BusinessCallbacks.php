<?php

namespace Siravel\Observers;

use Auth;
use Business;
use Event;
use Facilitador;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Log;
use Siravel\Scopes\BusinessScope;
use Support\Models\Base;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Telefonica\Models\Digital\Email;
use Throwable;

/**
 * Call no-op classes on models for all event types.  This just simplifies
 * the handling of model events for models.
 */
class BusinessCallbacks
{
    /**
     * Handle all model events, both Eloquent and Decoy
     *
     * @param  string $event
     * @param  array  $payload Contains:
     *                         -
     *                         Facilitador\Models\Base
     *                         $model
     * @return void
     */
    public function handle($event, $payload)
    {
        list($model) = $payload;

        // // Payload
        // ^ Cmgmyr\Messenger\Models\Message^ {#4332
        //     #table: "messages"
        //     #touches: array:1 [
        //       0 => "thread"
        //     ]
        //     #fillable: array:3 [
        //       0 => "thread_id"
        //       1 => "user_id"
        //       2 => "body"
        //     ]
        //     #dates: array:1 [
        //       0 => "deleted_at"
        //     ]
        //     #connection: null
        //     #primaryKey: "id"
        //     #keyType: "int"
        //     +incrementing: true
        //     #with: []
        //     #withCount: []
        //     #perPage: 15
        //     +exists: false
        //     +wasRecentlyCreated: false
        //     #attributes: []
        //     #original: []
        //     #changes: []
        //     #casts: []
        //     #dateFormat: null
        //     #appends: []
        //     #dispatchesEvents: []
        //     #observables: []
        //     #relations: []
        //     +timestamps: true
        //     #hidden: []
        //     #visible: []
        //     #guarded: array:1 [
        //       0 => "*"
        //     ]
        //     #forceDeleting: false
        //   }

        // // Ignore
        // if (!app()->bound(Business::class)) {
        //     dd(app()->bound(Business::class));
        //     return true;
        // }
        // dd(Schema::hasColumn($model->getTable(), 'business_code'));
        if (!Schema::hasColumn($model->getTable(), 'business_code') || Business::isToIgnore()) {
            return true;
        }
        // if (!Business::isToApplyCodeBusiness($model))
        // {
        //     return true;
        // }
          

        // Get the action from the event name
        preg_match('#\.(\w+)#', $event, $matches);
        $action = $matches[1];

        // If there is matching callback method on the model, call it, passing
        // any additional event arguments to it
        $method = 'on'.Str::studly($action);
        if ($method == 'onBooting') {
            $model::addGlobalScope(new BusinessScope);
            return true;
        }


        // // Ignore
        // if (!app()->bound(BusinessService::class)) {
        //     dd('aa');
        //     return true;
        // }

        if ($method == 'onCreating') {
            if (!empty($model->business_code) && $model->business_code!==Business::getCode()) {
                throw new Exception('Erro de segurança');
            }
            $model->business_code = Business::getCode();
            if (Auth::check()) {
                // @todo Verifica se tem acesso
            }
            return true;
        }
        
        if ($method == 'onCreated') {
            return true;
        }
        
        if ($method == 'onValidating' || $method == 'onValidated') {
            return true;
        }

        return true;
    }
}

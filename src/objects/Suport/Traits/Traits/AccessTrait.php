<?php
/**
 * CLasse criada para controlar os acessos dentro de determinado modelo
 */

namespace App\Models\Traits;

use Illuminate\Support\Facades\Log;
use App\Models\Model;
use Auth;
use Illuminate\Database\Eloquent\Builder;

trait AccessTrait
{
    use EloquentGetTableNameTrait;

    protected static function bootAccessTrait()                                                                                                                                                             
    {
        //@todo
    }
}

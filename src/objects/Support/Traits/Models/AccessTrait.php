<?php
/**
 * CLasse criada para controlar os acessos dentro de determinado modelo
 */

namespace SiObjects\Support\Traits\Models;

use Illuminate\Support\Facades\Log;
use App\Models\Model;
use Auth;
use Illuminate\Database\Eloquent\Builder;

trait AccessTrait
{
    use EloquentGetTableNameTrait;

    public static function bootAccessTrait()                                                                                                                                                             
    {
        //@todo
    }
}

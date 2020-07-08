<?php
/**
 * Created by PhpStorm.
 * User: sierra
 * Date: 8/20/17
 * Time: 10:48 PM
 */

namespace Siravel\Http\Controllers\Features\Travels;


use Siravel\Logic\Fluxo\Options;
use App\Models\Contact;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Mail;
use Validator;
use View;

class PagesController extends Controller
{
    /**
     * PagesController constructor.
     */
    function __construct()
    {
        $this->middleware('web');
    }
}

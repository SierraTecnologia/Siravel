<?php
/**
 * Created by PhpStorm.
 * User: sierra
 * Date: 8/20/17
 * Time: 10:48 PM
 */

namespace Siravel\Http\Controllers\Features\Travels;


use Siravel\Logic\Fluxo\Options;
use App\Models\Travel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Mail;
use Validator;
use View;
use App\Services\HotelBeds;
use Carbon\Carbon;

class TravelsController extends Controller
{
    /**
     * PagesController constructor.
     */
    function __construct()
    {
        $this->middleware('web');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function contact()
    {
        return View::make('components.contact');
    }


    public function recheck($rateKey)
    {
        $travel = new HotelBeds();
        $resultTravels = $travel->recheck($rateKey);
        return View::make('pages.travel-recheck')->with('resultTravels', $resultTravels)->with('rqCheckRate', $travel->getRqCheckRate());
    }

    public function booking($rateKey)
    {
        $travel = new HotelBeds();
        $resultTravels = $travel->booking($rateKey);
        return View::make('pages.travel-booking')->with('resultTravels', $resultTravels)->with('rqBookingConfirm', $travel->getRqBookingConfirm());
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTravel()
    {
        $validation = Validator::make(Input::all(), \App\Models\Travel::rules());

        $dateInit = Carbon::createFromFormat('d/m/Y', Input::get("date_init"))->toDateString();
        $dateEnd = Carbon::createFromFormat('d/m/Y', Input::get("date_end"))->toDateString();
        $destine = Input::get("destine");
//        $adults = Input::get("adults");
//        $chieldren = Input::get("chieldren");
//        $rooms = Input::get("rooms");
        $adults = 2;
        $chieldren = 1;
        $rooms = 1;


        if ($validation->passes()) {


            $travel = new HotelBeds();
            $travel->includeDateInterval($dateInit, $dateEnd);
            $travel->includeDestine($destine);
            $travel->includePeoples($adults, $chieldren, $rooms);

            $travelSaveInDb = new Travel();
            if (\Auth::check()) {
                $travelSaveInDb->user_id = \Auth::user()->id;
            }
            $travelSaveInDb->destine = $destine;
            $travelSaveInDb->date_init = $dateInit;
            $travelSaveInDb->date_end = $dateEnd;
            $travelSaveInDb->adults = $adults;
            $travelSaveInDb->chieldren = $chieldren;
            $travelSaveInDb->rooms = $rooms;
            $travelSaveInDb->status = 0;
            $travelSaveInDb->user_token = uniqid(rand(), true);
            $travelSaveInDb->save();

            $resultTravels = $travel->returnAvaliables();


            return View::make('pages.travel-config')->with('message', trans('contact.SendWithSuccess'))->with('resultTravels', $resultTravels)->with('rqData', $travel->getRqData());

        }

        return Redirect::to('/')
            ->withInput()
            ->withErrors($validation)
            ->with('message', trans('contact.errorInEmailSend'));

    }
}

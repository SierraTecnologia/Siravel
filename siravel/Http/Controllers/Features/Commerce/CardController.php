<?php

namespace Siravel\Http\Controllers\Features\Commerce;

use Illuminate\Http\Request;
use Siravel\Http\Controllers\Controller;
use App\Services\Commerce\CustomerProfileService;

class CardController extends Controller
{
    public function __construct(CustomerProfileService $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Display the get card.
     *
     * @param int $id
     *
     * @return Illuminate\Http\Response
     */
    public function getCard()
    {
        if (is_null(auth()->user()->meta->sitecpayment_id)) {
            return view('features.commerce.profile.card.set');
        }

        return view('features.commerce.profile.card.get');
    }

    /**
     * Display the change card.
     *
     * @return Illuminate\Http\Response
     */
    public function changeCard()
    {
        return view('features.commerce.profile.card.change');
    }

    /**
     * Set a credit card.
     *
     * @param Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function setCard(Request $request)
    {
        $user = auth()->user();

        if (is_null($user->meta->sitecpayment_id) && $request->input('sitecpaymentToken')) {
            $user->meta->createAsSierraTecnologiaCustomer($request->input('sitecpaymentToken'));
        } elseif ($request->input('sitecpaymentToken')) {
            $user->meta->updateCard($request->input('sitecpaymentToken'));
        }

        return redirect('store/account/card')->with('message', 'Successfully set your credit card');
    }
}

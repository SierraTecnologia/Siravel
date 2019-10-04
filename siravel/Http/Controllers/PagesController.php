<?php
/**
 * Created by PhpStorm.
 * User: sierra
 * Date: 8/20/17
 * Time: 10:48 PM
 */

namespace Siravel\Http\Controllers;


use Siravel\Models\Contact;
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHome()
    {
        return view('pages.home');

    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function contact()
    {
        return View::make('components.contact');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postContact()
    {

        $rules = array('name' => 'required', 'email' => 'required|email', 'message' => 'required');

        $validation = Validator::make(Input::all(), $rules);

        $data = array();

        $data['name'] = Input::get("name");

        $data['email'] = Input::get("email");

        $data['text'] = Input::get("message");

        if ($validation->passes()) {

            $contato = new Contact;
            $contato->site = getenv('APP_NAME', 'SierraTecnologia');
            $contato->name = $data['name'];
            $contato->email =$data['email'];
            $contato->subject = trans('contact.formContact');
            $contato->text = $data['text'];
            $contato->save();
            $subject = getenv('EMAIL_CONTACT_TITLE', 'SiTec Contato - ').$contato->subject;
            try {
                Mail::send('emails.contact', $data, function ($message) use ($subject) {

                    $message->from(Input::get('email'), Input::get('nome'));

                    $message->to(getenv('EMAIL_CONTACT', 'atendimento@sierratecnologia.com.br'))->subject($subject);

                });
            }
            catch (\Exception $e) {
                mail(
                    getenv('EMAIL_CONTACT', 'atendimento@sierratecnologia.com.br'),
                    $subject,
                    implode(',', $data)

                );
                Log::notice(trans('contact.emailNotSend').' '.print_r($contato, true));
            }
            return Redirect::to('contato')->with('message', trans('contact.SendWithSuccess'));

        }

        return Redirect::to('contato')
            ->withInput()
            ->withErrors($validation)
            ->with('message', trans('contact.errorInEmailSend'));

    }
}

<?php

namespace Siravel\Http\Requests;

use Auth;
use Gate;
use App\Models\Calendar\Event;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (config('app.env') !== 'testing') {
            return Gate::allows('cms', Auth::user());
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Event::$rules;
    }
}

<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ReserveCabinetRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cabinet_id' => 'required|exists:cabinets,id',
            'name' => 'required|max:120',
            'email' => 'required|email|regex:/(.*)@(.*)\.(.*)/i',
            'phone' =>
                [
                    'regex:/[0-9]{12}/',
                    'min:12',
                    'max:12',
                    'required',

                ],
            'from_date_time' => 'required|date_format:Y-m-d H:i|after_or_equal:'.Carbon::now(),
            'to_date_time' => 'required|date_format:Y-m-d H:i|after_or_equal:from_date_time'
        ];
    }
}

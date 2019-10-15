<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [


            'client' =>  'required',  
            'email' =>  'required|email',
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'address' => 'required',
            'city' => 'required',
            'postcode' => 'required| ',
            'servers' => 'required|numeric',
            'workstations' => 'required|numeric',
            'printers' => 'required|numeric'
                
       
        ];
    }
}

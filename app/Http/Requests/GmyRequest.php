<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GmyRequest extends FormRequest
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
        if(Auth::user()->hasRole('Super-Admin')){
            return [ 
                'name' => ['required','min:4','max:15'],
                'image' => ['image','mimes:jpg,png,jpeg'],
                'city_id' => ['required'],  
            ];
        }
        else
        {
            return [ 
                'name' => ['required','min:4','max:15'],
                'image' => ['image','mimes:jpg,png,jpeg'],  
            ];
        }
        
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A title is required.',
            'image.required' => 'The Gym image field can not be empty value.',
            'image.mimes' => 'The Gym image extention shloud be in (pg,png,jpeg)',
        ];
    }
}

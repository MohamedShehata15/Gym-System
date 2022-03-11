<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingPackageRequest extends FormRequest
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
                'Name' => ['required','min:3','max:15'],
                'Price' => ['required','numeric'],
                'sessionNum' => ['required','numeric','max:30','gt:0'],
                'gym'=>['required'],  
            ];
    }
    public function messages()
    {
        return [
            'Name.required' => 'Name is required.',
            'Price.required' => 'You must enter the price of Package',
            'sessionNum.required' => 'You must enter the Session Number',
            'sessionNum.max' => 'Maximum number must be 30 sessions',
            'gym.required' => 'Choose the Gym',
        ];
    }
}

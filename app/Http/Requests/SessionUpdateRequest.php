<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessionUpdateRequest extends FormRequest
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
            'name' => ['required'],
            'start' => ['required'], 
            'day' => ['required'], 
            'finish' => ['required','after:start'], 
            'coaches'=>['required','exists:staff,id'],//prevent from inspects hacks
        ];
    }
    public function messages()
    {
      return [
             'name.required' =>'You must Enter a name for session :( ',
             'day.required' =>'You must choose a date:( ',
             'start.required' =>'You must choose a start time:( ',
             'finish.required'=>'You must choose a finishing time ',
             'finish.after'=>'You must choose a time after start time',
             'coaches.required'=>'You must choose one or more coach ',
             'coaches.exists'=>'I got you, Stop doing this -_-',
         ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GymManagerRequest extends FormRequest
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
        $id = request()->all()['id'] ?? "";
        return [ 
            'name' => ['required','min:4','max:15'],
            'email' => 'required|email|unique:staff,email,'.$id,
            'password' => ['required','min:6','max:20'],
            'confirm'=>['required','same:password'],
            'avatar' =>['image','mimes:jpg,png,jpeg'],
            'national_id'=> 'required|numeric|digits:10|unique:staff,national_id,'.$id,
            'city' => ['required'],
            'gym' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'You must enter the name',
            'email.email' => 'invalid email',
            'national_id.digits' => 'The national id must be 10 number',
            'avatar.mimes' => 'The image extention shloud be in (jpg,png,jpeg)',
        ];
    }
}

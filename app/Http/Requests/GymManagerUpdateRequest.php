<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GymManagerUpdateRequest extends FormRequest
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
            'old_password' => ['nullable'],
            'password' => ['min:6','max:20','nullable'],
            'confirm'=>['same:password','nullable'],
            'avatar' =>['image','mimes:jpg,png,jpeg'],
            'national_id'=> 'required|numeric|digits:10|unique:staff,national_id,'.$id,
            'city' => ['required'],
            'gym' => ['required'],
        ];
    }
}

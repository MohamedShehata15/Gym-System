<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = Request()->all()['id']??"";
        return [
                "old_password" => "required_with:password",
                "password" => "confirmed|different:old_password|required_with:old_password",
                "password_confirmation" => "required_with:password|required_with:old_password",
                "email" => "unique:users,email," . $id
        ];
    }
}

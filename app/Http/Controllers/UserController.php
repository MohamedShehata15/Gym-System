<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        $token = $user->createToken($request->email)->plainTextToken;

        return ['token'=>$token, 'data'=>new UserResource($user)];

    }

    public function register(Request $request){ 
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'gender'=>'required',
            'password'=>'required|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation'=>'required',
            // 'date_of_birth'=>'required',
            // 'avatar'=>'required'
        ]);
    
        $data = $request->all();
        $data['password']=Hash::make($data['password']);
        $user = User::create($data);
        $token = $user->createToken($request->email)->plainTextToken;

        return ['token'=>$token, 'data'=>new UserResource($user)];
    }
}



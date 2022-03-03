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
         
        $user->remember_token = $token;
        $user->save();

        return ['token'=>$token, 'data'=>new UserResource($user)];

    }

    //=========================================================================//

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

    //=========================================================================//

    public function update(Request $request){
        $request->validate([
                "old_password" =>"required_with:password",
                "password" =>"confirmed|different:old_password|required_with:old_password",
                "password_confirmation" =>"required_with:password|required_with:old_password",
                "email"=>"unique:users"
              ]);    

      $token = explode(' ', $request->header()['authorization'][0])[1];
      $user = User::where('remember_token', $token)->first();
      if (! $user) {
        throw ValidationException::withMessages([
            'remember_token' => ['It does not match'],
        ]);
    }
    $data = $request->all();
    $exist = array_key_exists('old_password', $data);
    if($exist) {
        if(Hash::check($data['old_password'], $user->password)){
            $data['password']=Hash::make($data['password']);
          }
        else{
            throw ValidationException::withMessages([
                'password' => ['The current password is invalid'],
            ]);
        }
    } 

     $user->update($data);
        return new UserResource($user);

    }

        //=========================================================================/
}



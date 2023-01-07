<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function register(Request $request){
       $validator = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' =>'required'
        ]);

$validator = validator(request()->all(), [   
    'name' => 'required|max:255',
    'email' => 'required|unique:users',
    'password' =>'required|min:8'   ]);
      
    if($validator -> fails()){
            return response()-> json([
                "validation_error" => $validator->messages()
            ]);
            }
            else{
              
                $user =User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
               $token = $user->createToken($user->email.'_Token', [''])->plainTextToken;
                return response()-> json([
                    "status" => 200,
                    "message" => "success",
                    "username"=> $user->name,
                    "token" => $token
                ]);
            }
        }

        function login(Request $request)
        {
 
            $validator = validator(request()->all(), [   
               
                'email' => 'required',
                'password' =>'required'   ]);
                  
                if($validator -> fails()){
                        return response()-> json([
                            "validation_error" => $validator->messages()
                        ]);
                        }       
                else{
                    
                    $user = User::where('email', $request->email)->first();
 
                    if (! $user || ! Hash::check($request->password, $user->password))
                        {        
                            return response() -> json([
                            'status' => 401,
                            'message' => ['The provided credentials are incorrect.']
                            ]);
                        }
   
                   else{ 
                       if($user->role_as ==1)
                       {
                           $role='admin';
                        $token = $user->createToken($user->email.'adminToken', ['server:admin'])->plainTextToken;
                       }
                       else{
                           $role ='';
                        $token = $user->createToken($user->email.'_Token', [''])->plainTextToken;
                       }
                       
                        return response()-> json([
                           "status" => 200,
                           "username"=> $user->name,
                           "token" => $token,
                           "message" => "login success",
                            "role"=> $role
                        ]);
                      }
                }   
  

        }

        function logout()
        {
            Auth()->user()->tokens()->delete();
                   
            return response() -> json([
                'status' => 200,
                'message' =>'log out successfully'
                ]);
        }


}


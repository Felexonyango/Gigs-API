<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        $rules = [
            'name'=> 'required',
            'email' => 'unique:users|required|email',
            'password' => 'required|string',
        ];
        $input  = $request->only('name','email','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }
    
        $user= User::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password' => bcrypt($request['password']),
        ]);
        
        $token=$user->createToken('token')->plainTextToken;


    
        return response()->json(['success' => true, 'token' => $token],200);


       }
       public function login(Request $request){
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $input  = $request->only('email','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();

            $token=$user->createToken('token')->plainTextToken;
            
            return response()->json(['success' => true, 'token' => $token],200);
        }
        else{
            return response()->json(['success'=>false,'error'=>'wrong login credentials' ], 500);
        }
        

       }
       public function logout(Request $request)
       {
           auth()->user()->tokens()->delete();
   
           return [
               'message' => 'Logged out successfully'
           ];
       }

    }
    


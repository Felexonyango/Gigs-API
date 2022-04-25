<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Suggestion;
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
            'password' => Hash::make($request['password'])
        ]);

    
        return response()->json(['success' => true, 'response' => $user]);


       }
       public function login(Request $request){


       }

    }


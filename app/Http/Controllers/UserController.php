<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\SignupRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class UserController extends Controller
{
    public function register(SignupRequest $user)  {
        try {//dd("hello");
            $validated = $user->validated();
            $validated['password'] = bcrypt($validated['password']);

            User::create($user->validated());
            return response()->json(['success'=>true,'message'=>'User registered successfully']);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'message'=>'Something went wrong during registration','error'=>$e->getMessage()]);
        }
    }

    public function login(LoginRequest $user) {
        try {
            // return response()->json(['message'=>'Hello']);
            // dd("hello");
            if(Auth::attempt($user->validated())){
                // dd("hello");
                $token = auth()->user()->createToken('Token name')->accessToken;
                return response()->json(['token'=>$token, 'status'=>200]);
            }else{
                return response()->json(['message'=>'Unauthorized', 'status'=>401]);
            }
            
        } catch (\Exception $e) {
            // dd("hello catched");
            return response()->json(['message'=>'Something went wrong', 'status'=>401, 'error'=>$e->getMessage()]);
        }
    }
}

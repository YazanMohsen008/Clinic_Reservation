<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SystemAdminController extends Controller
{

    public function register(Request $request)
    {
        return User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'password' => Hash::make($request->input('password'))]
        );
    }

    public function login(Request $request)
    {

        $user = $request->only('email', 'password');
        if (!Auth('system_admin')->attempt($user)) {
            return response()->json(["message"=>"Login Failed"], 401);
        }

        $user =Auth('system_admin')->user();

        $token = $user->createToken('token')->plainTextToken;
//        $cookie=cookie('jwt',$token,60*24);
        return response()->json(["message"=>"Success","token:"=>$token], 200);
//        ->withCookie($cookie);
    }

    public function getUser(){
    return Auth('system_admin')->user();
    }
    public function logout(){
//        Cookie::forget('jwt');
        auth('system_admin')->user()->tokens()->delete();
     return response()->json(["message"=>"Success"], 200);
    }


}

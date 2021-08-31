<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SystemAdminController extends Controller
{

    public function index()
    {
        return response()->json(User::get(), 200);
    }
    public function store(Request $request)
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
        return response()->json(["message"=>"Success","token:"=>$token], 200);
    }

    public function getUser(){
    return User::find(Auth()->user()->getAuthIdentifier());
    }
    public function logout(){
        auth()->user()->tokens()->delete();
     return response()->json(["message"=>"Success"], 200);
    }


}

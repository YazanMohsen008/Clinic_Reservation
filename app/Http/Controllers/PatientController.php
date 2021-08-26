<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function index()
    {
        return response()->json(Patient::get(), 200);

    }

    public function store(Request $request)
    {
        $rules=[
            'full_name'=>'required|min:3',
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
            return response()->json($validator->errors(),400);
        $request["password"]=Hash::make($request["password"]);
        $Data = Patient::create($request->all());
        return response()->json($Data, 201);
    }

    public function login(Request $request)
    {
        $user = $request->only('email', 'password');

        if (!Auth('patient')->attempt($user)) {
            return response()->json(["message"=>"Login Failed"], 401);
        }
        $user =Auth('patient')->user() ;
        $token = $user->createToken('token')->plainTextToken;
//        $cookie=cookie('jwt',$token,60*24);
        return response()->json(["message"=>"Success","token:"=>$token], 200);
//        ->withCookie($cookie);
    }

    public function getUser(){
        return Auth('patient')->user();
    }
    public function logout(){
//        Cookie::forget('jwt');
        auth('patient')->user()->tokens()->delete();
        return response()->json(["message"=>"Success"], 200);
    }

    public function show($id)
    {
        $Data = Patient::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->reservationRequests;
        return response()->json($Data, 200);
    }
    public function showPatientReservations($id)
    {
        $Data = Patient::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        return response()->json($Data->reservationRequests, 200);
    }
    public function showPatientConsultations($id)
    {
        $Data = Patient::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        return response()->json($Data->consultations, 200);
    }
    public function update(Request $request, $id)
    {
        $Data = Patient::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->update($request->all());
        return response()->json($Data, 200);
    }

    public function destroy($id)
    {
        $Data = Patient::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->delete();
        return response()->json(null, 204);
    }
}



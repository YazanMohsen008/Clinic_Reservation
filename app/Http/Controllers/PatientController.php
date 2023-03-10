<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Specialization;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Sanctum;

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
        $user=Patient::create($request->all());

        return response()->json(["message"=>"Success","user"=>$user], 200);
    }

    public function login(Request $request)
    {
        $user = $request->only('email', 'password');

        if (!Auth('patient')->attempt($user)) {
            return response()->json(["message"=>"Login Failed"], 401);
        }
        $user =Auth('patient')->user();
        $token = $user->createToken('token')->plainTextToken;
        return response()->json(["message"=>"Success","token"=>$token,"user"=>$user], 200);
    }


    public function getUser(){

        return $this->show(Auth()->user()->getAuthIdentifier());
    }
    public function logout(){
        auth()->user()->tokens()->delete();
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
    public function showPatientReservations()
    {
        $id=Auth::user()->getAuthIdentifier();
        $Data = Patient::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);

        $reservationRequests=$Data->reservationRequests;
	    $i=0;
        $responses=[];
        foreach ($reservationRequests as $reservationRequest)
            {
		$responses[$i]["reservation_id"]=$reservationRequest["id"];
		$responses[$i]["reservation_date"]=$reservationRequest["reservation_date"];
		$responses[$i]["reservation_status"]=$reservationRequest["status"];
		$responses[$i]["reservation_time"]=$reservationRequest["reservation_time"];
		$clinic=$reservationRequest->clinic;
		$responses[$i]["clinic_id"]=$clinic["id"];
		$responses[$i]["doctor_name"]=$clinic["doctor_name"];
                $i++;
	}

        return response()->json($responses, 200);
    }
    public function showPatientConsultations()
    {
        $id=Auth::user()->getAuthIdentifier();
        $Data = Patient::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $consultations=$Data->consultations;
        foreach ($consultations as $consultation) {
            $consultation->clinic;
            $consultation["specialization"] = Specialization::find($consultation["clinic_specialization"]);
        }

        return response()->json($Data->consultations, 200);
    }
    public function update(Request $request)
    {
        $id=Auth::user()->getAuthIdentifier();
        $Data = Patient::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->update($request->all());
        return response()->json($Data, 200);
    }

    public function destroy()
    {
        $id=Auth::user()->getAuthIdentifier();
        $Data = Patient::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->delete();
        return response()->json(null, 204);
    }
}



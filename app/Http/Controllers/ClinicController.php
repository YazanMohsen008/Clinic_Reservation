<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\PhoneNumber;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClinicController extends Controller
{
    public function index()
    {
        return response()->json(Clinic::get(), 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return response()->json($validator->errors(), 400);
        $request["password"]=Hash::make($request["password"]);

        //phone Number Storing
        $phoneNumberController = new PhoneNumberController;
        $phoneNumbers = $request->input("phoneNumbers");

        //phone Number Validating
        foreach ($phoneNumbers as $phoneNumber) {
            $phoneNumberData = $phoneNumberController->validate(["phone_number" => $phoneNumber]);
            if ($phoneNumberData!=null && $phoneNumberData->getStatusCode() == 400)
                return $phoneNumberData;
        }

        $Data = Clinic::create($request->all());
        foreach ($phoneNumbers as $phoneNumber)
            $phoneNumberController->storePhoneNumber(["phone_number" => $phoneNumber, "clinicId" => $Data['id']]);
        return response()->json($Data, 201);
    }

    public function login(Request $request)
    {
        $user = $request->only('email', 'password');

        if (!Auth('clinic')->attempt($user)) {
            return response()->json(["message"=>"Login Failed"], 401);
        }
        $user =Auth('clinic')->user() ;
        $token = $user->createToken('token')->plainTextToken;
//        $cookie=cookie('jwt',$token,60*24);
        return response()->json(["message"=>"Success","user"=>$user,"token:"=>$token], 200);
//        ->withCookie($cookie);
    }

    public function getUser(){
        return response()->json(Auth('clinic')->user(), 200);
    }
    public function logout(){
//        Cookie::forget('jwt');
        auth('clinic')->user()->tokens()->delete();
        return response()->json(["message"=>"Success"], 200);
    }


    public function show($id)
    {
        $Data = Clinic::find($id);
        if (is_null($Data))
            return response()->json(["message" => "404 Not Found"], 404);
        $Data->specialization;
        $Data->phoneNumber;
        $Data->reservations;
        return response()->json($Data, 200);
    }
    public function MyReservations($id)
    {
        $Data = Clinic::find($id);
        if (is_null($Data))
            return response()->json(["message" => "404 Not Found"], 404);
        $reservations = $Data->reservations;
        $counter=0;
        for($i=0;$i<sizeof($reservations);$i++){
            $reservation=$reservations[$i];

            if($reservation["status"]=="pending") {
                $info[$counter]["reservation_id"]=$reservation["id"];
                $info[$counter]["reservation_date"]=$reservation["reservation_date"];
                $info[$counter]["request_type"]=$reservation["request_type"];
                $patient=$reservation->patient;
                $info[$counter]["patient_name"]=$patient["full_name"];
                $info[$counter]["patient_phone_number"]=$patient["phone_number"];
                $pendingReservations[$i] = $reservation;
                $counter++;
            }
        }

        return response()->json($info, 200);
    }
    public function searchByName($name)
    {
        $clinics = Clinic::where('name' ,'like', "%".$name."%")->get();
        if (is_null($clinics))
            return response()->json(["message" => "404 Not Found"], 404);
        foreach ($clinics as $clinic) {
            $clinic->specialization;
            $clinic->phoneNumber;
            $clinic->reservations;
        }
        return response()->json($clinics, 200);
    }


    public function update(Request $request, $id)
    {
        $Data = Clinic::find($id);
        if (is_null($Data))
            return response()->json(["message" => "404 Not Found"], 404);
        $Data->update($request->all());
        return response()->json($Data, 200);
    }

    public function destroy($id)
    {
        $Data = Clinic::find($id);
        if (is_null($Data))
            return response()->json(["message" => "404 Not Found"], 404);
        $Data->delete();
        return response()->json(null, 204);
    }
}

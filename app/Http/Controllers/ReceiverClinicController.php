<?php

namespace App\Http\Controllers;

use App\Models\ReceiverClinic;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ReceiverClinicController extends Controller
{
    public function index()
    {
        return response()->json(ReceiverClinic::get(), 200);

    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response()->json($validator->errors(), 400);
        $Data = ReceiverClinic::create($request->all());
        return response()->json($Data, 201);
    }

    public function storeClinic(array $clinic)
    {
        $Data = ReceiverClinic::create($clinic);
        return response()->json($Data, 201);
    }


    public function show($id)
    {
        $Data = ReceiverClinic::find($id);
        if (is_null($Data))
            return response()->json(["message" => "404 Not Found"], 404);
        $Data->receiver_clinic;
        $Data->patient_file_transfer_request;
        return response()->json($Data, 200);
    }

    public function showClinicTransferRequests( $clinic_id)
    {
        //TODO $clinic_id is From logged in Clinic not Request
        $request = ReceiverClinic::where(['receiver_clinic_id' => $clinic_id])->get();
        $patient_file_transfer_request=$request[0]->patient_file_transfer_request;
        $patient_file_transfer_request->clinic;
        $patientCard=$patient_file_transfer_request->PatientCard;
        $patientCard->extraInformation;
        $diagnosis=$patientCard->diagnosis;
        for($i=0;$i<sizeof($diagnosis);$i++) {
            $diagnosis[$i]->medicines;
            $diagnosis[$i]->attachments;
        }
        if (is_null($request))
            return response()->json(["message" => "404 Not Found"], 404);
        return response()->json(["Data:" => $request], 200);
    }

    public function update(Request $request, $id)
    {
        $Data = ReceiverClinic::find($id);
        if (is_null($Data))
            return response()->json(["message" => "404 Not Found"], 404);
        $Data->update($request->all());
        return response()->json($Data, 200);
    }

    public function destroy($id)
    {
        $Data = ReceiverClinic::find($id);
        if (is_null($Data))
            return response()->json(["message" => "404 Not Found"], 404);
        $Data->delete();
        return response()->json(null, 204);
    }
}



<?php

namespace App\Http\Controllers;

use App\Models\ReceiverClinic;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
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

    public function previewClinicTransferRequests( )
    {
        $clinic_id=Auth::user()->getAuthIdentifier();
        $requests = ReceiverClinic::where(['receiver_clinic_id' => $clinic_id])->get();
        foreach ($requests as $request) {
            $patient_file_transfer_request = $request->patient_file_transfer_request;
            $patient_file_transfer_request->clinic;
            $patientCard = $patient_file_transfer_request->PatientCard;
            $patientCard->extraInformation;
            if (is_null($request))
                return response()->json(["message" => "404 Not Found"], 404);

        }
        return response()->json($requests, 200);
    }

    public function downloadClinicTransferRequests( )
    {
        $clinic_id=Auth::user()->getAuthIdentifier();
        $requests = ReceiverClinic::where(['receiver_clinic_id' => $clinic_id])->get();
        foreach ($requests as $request) {
            $patient_file_transfer_request = $request->patient_file_transfer_request;
            $patient_file_transfer_request->clinic;
            $patientCard = $patient_file_transfer_request->PatientCard;
            $patientCard->extraInformation;

            $diagnosis = $patientCard->diagnosis;
            for ($i = 0; $i < sizeof($diagnosis); $i++) {
                $dia=$diagnosis[$i];
                $prescriptions = $dia->prescriptions;
            for ($j = 0; $j < sizeof($prescriptions); $j++) {
                $prescription = $prescriptions[$j];
                $prescription->medicines;
            }
                $diagnosis[$i]->attachments;
            }
            if (is_null($request))
                return response()->json(["message" => "404 Not Found"], 404);
        }
        return response()->json($requests, 200);
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



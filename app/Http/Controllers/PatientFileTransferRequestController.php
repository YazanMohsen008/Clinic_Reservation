<?php

namespace App\Http\Controllers;

use App\Models\PatientCard;
use App\Models\PatientFileTransferRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class PatientFileTransferRequestController extends Controller
{
    public function index()
    {
        return response()->json(PatientFileTransferRequest::get(), 200);

    }

    public function store(Request $request)
    {
        $rules=[
            'date'=>'required',
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
            return response()->json($validator->errors(),400);
        $Data = PatientFileTransferRequest::create($request->all());

        $patientCardController=new PatientCardController;
        $patientCard=$patientCardController->storePatientCard($request->input("patient_card"));
        $Data["patient_Id"]=$patientCard["id"];

        $receiverClinicController = new ReceiverClinicController();

        $receiverClinics = $request["receiver_clinics"];

        foreach ($receiverClinics as $receiverClinicID) {
            $receiverClinic["patient_file_transfer_request_id"]=$Data["id"];
            $receiverClinic["receiver_clinic_id"]=$receiverClinicID;
            $receiverClinic["date"]=$Data["date"];
            $receiverClinicController->storeClinic($receiverClinic);
        }
        $Data->save();
        return response()->json($Data, 201);
    }


    public function show($id)
    {
        $Data = PatientFileTransferRequest::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->receiverClinics;
        $Data->clinic;
        $patientCard=$Data->PatientCard;
        $patientCard->extraInformation;
        $diagnosis=$patientCard->diagnosis;
        for($i=0;$i<sizeof($diagnosis);$i++) {
            $diagnosis[$i]->medicines;
            $diagnosis[$i]->attachments;
        }
        return response()->json($Data, 200);
    }

    public function update(Request $request, $id)
    {
        $Data = PatientFileTransferRequest::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->update($request->all());
        return response()->json($Data, 200);
    }

    public function destroy($id)
    {
        $Data = PatientFileTransferRequest::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->delete();
        return response()->json(null, 204);
    }
}



<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\ExtraInformation;
use App\Models\PatientCard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class DiagnosisController extends Controller
{
    public function index()
    {
        return response()->json(Diagnosis::get(), 200);

    }

    public function store(Request $request)
    {
        $rules=[
            'disease'=>'required|min:3',
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
            return response()->json($validator->errors(),400);
        $Data = Diagnosis::create($request->all());
        return response()->json($Data, 201);
    }

    public function storeDiagnosis(array $diagnosis)
    {
        $Data = Diagnosis::create($diagnosis);
        $medicineController = new MedicineController();
        $medicines = $diagnosis["medicines"];
        foreach ($medicines as $medicine) {
            $medicine["diagnosis_Id"]=$Data["id"];
            $medicineController->storeMedicine( $medicine);
        }
        $attachmentController = new AttachmentController();
        $attachments = $diagnosis["attachments"];
        foreach ($attachments as $attachment) {
            $attachment["diagnosis_Id"]=$Data["id"];
            $attachmentController->storeAttachment($attachment);
        }
    }


    public function show($id)
    {
        $Data = Diagnosis::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->patient;
        $Data->medicines;
        $Data->attachments;
        return response()->json($Data, 200);
    }

    public function update(Request $request, $id)
    {
        $Data = Diagnosis::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->update($request->all());
        return response()->json($Data, 200);
    }

    public function destroy($id)
    {
        $Data = Diagnosis::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->delete();
        return response()->json(null, 204);
    }
}



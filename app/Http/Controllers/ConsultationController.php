<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Consultation;
use App\Models\Patient;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{
    public function index()
    {
        return response()->json(Consultation::get(), 200);
    }

    public function store(Request $request)
    {
        $rules=[
            'content'=>'required|min:3',
        ];
        $request["patient_Id"]=Auth::user()->getAuthIdentifier();
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
            return response()->json($validator->errors(),400);
        $Data = Consultation::create($request->all());
        return response()->json($Data, 201);
    }


    public function show($id)
    {
        $Data = Consultation::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->clinic;
        $Data->patient;
        return response()->json($Data, 200);
    }
    public function showSpecializationConsultations()
    {
        $clinic=Clinic::find(Auth::user()->getAuthIdentifier());
        $specialization_id=$clinic["specializationId"];
        $consultations = Consultation::where(['clinic_specialization' => $specialization_id,'response'=>null])->get();
        if (is_null($consultations))
            return response()->json(["message"=>"404 Not Found"], 404);
        foreach ($consultations as $consultation)
        $consultation["specialization"]=$clinic->specialization;
        return response()->json($consultations, 200);
    }

    public function update(Request $request, $id)
    {
        $Data = Consultation::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $request["response_clinic_id"]=Auth::user()->getAuthIdentifier();
        $Data->update($request->all());
        return response()->json($Data, 200);
    }

    public function destroy($id)
    {
        $Data = Consultation::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->delete();
        return response()->json(null, 204);
    }
}



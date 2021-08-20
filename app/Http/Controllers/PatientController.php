<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\ReservationRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
        $Data = Patient::create($request->all());
        return response()->json($Data, 201);
    }


    public function show($id)
    {
        $Data = Patient::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->reservationRequests;
        return response()->json(["Data:"=>$Data], 200);
    }
    public function showPatientReservations($id)
    {
        $Data = Patient::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        return response()->json(["Data:"=>$Data->reservationRequests], 200);
    }
    public function showPatientConsultations($id)
    {
        $Data = Patient::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        return response()->json(["Data:"=>$Data->consultations], 200);
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



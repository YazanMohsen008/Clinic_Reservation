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


    public function show($id)
    {
        $Data = Diagnosis::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->patient;
        return response()->json(["Data:"=>$Data], 200);
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



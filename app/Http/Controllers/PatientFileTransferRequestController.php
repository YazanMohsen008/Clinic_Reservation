<?php

namespace App\Http\Controllers;

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
        return response()->json($Data, 201);
    }


    public function show($id)
    {
        $Data = PatientFileTransferRequest::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->clinic;
        $Data->PatientCard;
        return response()->json(["Data:"=>$Data], 200);
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



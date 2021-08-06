<?php

namespace App\Http\Controllers;

use App\Models\PatientCard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class PatientCardController extends Controller
{
    public function index()
    {
        return response()->json(PatientCard::get(), 200);

    }

    public function store(Request $request)
    {
        $rules=[
            'name'=>'required|min:3',
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
            return response()->json($validator->errors(),400);
        $Data = PatientCard::create($request->all());
        return response()->json($Data, 201);
    }


    public function show($id)
    {
        $Data = PatientCard::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        return response()->json(["Data:"=>$Data], 200);
    }

    public function update(Request $request, $id)
    {
        $Data = PatientCard::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->update($request->all());
        return response()->json($Data, 200);
    }

    public function destroy($id)
    {
        $Data = PatientCard::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->delete();
        return response()->json(null, 204);
    }
}



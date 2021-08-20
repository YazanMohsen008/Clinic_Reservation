<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class MedicineController extends Controller
{
    public function index()
    {
        return response()->json(Medicine::get(), 200);

    }

    public function store(Request $request)
    {
        $rules=[
            'name'=>'required|min:3',
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
            return response()->json($validator->errors(),400);
        $Data = Medicine::create($request->all());
        return response()->json($Data, 201);
    }


    public function storeMedicine(array $medicine)
    {
        $Data = Medicine::create($medicine);
        return response()->json($Data,201);
    }
    public function show($id)
    {
        $Data = Medicine::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->diagnosis;
        return response()->json(["Data:"=>$Data], 200);
    }

    public function update(Request $request, $id)
    {
        $Data = Medicine::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->update($request->all());
        return response()->json($Data, 200);
    }

    public function destroy($id)
    {
        $Data = Medicine::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->delete();
        return response()->json(null, 204);
    }
}



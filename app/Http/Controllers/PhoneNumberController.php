<?php

namespace App\Http\Controllers;

use App\Models\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

class PhoneNumberController extends Controller
{
    public function index()
    {
        return response()->json(PhoneNumber::get(), 200);
    }

    public function store(Request $request)
    {
        $rules=[
            'phone_number'=>'required|min:3',
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
            return response()->json($validator->errors(),400);
        $Data = PhoneNumber::create($request->all());
        return response()->json($Data, 201);
    }

    public function validate (array $phoneNumber){

        $rules=[
            'phone_number'=>'required|min:10',
        ];
        $validator=Validator::make($phoneNumber,$rules);
        if($validator->fails())
            return response()->json($validator->errors(),400);
    }
    public function show($id)
    {
        $Data = PhoneNumber::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->clinic;
        return response()->json(["PhoneNumber"=>$Data], 200);
    }

    public function storePhoneNumber(array $phoneNumber)
    {
        $Data = PhoneNumber::create($phoneNumber);
        return response()->json($Data,201);
    }

    public function update(Request $request, $id)
    {
        $Data = PhoneNumber::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->update($request->all());
        return response()->json($Data, 200);
    }

    public function destroy($id)
    {
        $Data = PhoneNumber::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->delete();
        return response()->json(null, 204);
    }

    public function __toString()
    {
     return "";
    }

}

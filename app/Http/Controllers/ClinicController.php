<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\PhoneNumber;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ClinicController extends Controller
{
    public function index()
    {
        return response()->json(Clinic::get(), 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return response()->json($validator->errors(), 400);


        //phone Number Storing
        $phoneNumberController = new PhoneNumberController;
        $phoneNumbers = $request->input("phoneNumbers");

        //phone Number Validating
        foreach ($phoneNumbers as $phoneNumber) {
            $phoneNumberData = $phoneNumberController->validate(["phone_number" => $phoneNumber]);
            if ($phoneNumberData!=null && $phoneNumberData->getStatusCode() == 400)
                return $phoneNumberData;
        }

        $Data = Clinic::create($request->all());
        foreach ($phoneNumbers as $phoneNumber)
            $phoneNumberController->storePhoneNumber(["phone_number" => $phoneNumber, "clinicId" => $Data['id']]);
        return response()->json($Data, 201);
    }

    public function show($id)
    {
        $Data = Clinic::find($id);
        if (is_null($Data))
            return response()->json(["message" => "404 Not Found"], 404);
        $Data->specialization;
        $Data->phoneNumber;
        $Data->reservations;
        return response()->json(["ClinicInfo" => $Data], 200);
    }


    public function update(Request $request, $id)
    {
        $Data = Clinic::find($id);
        if (is_null($Data))
            return response()->json(["message" => "404 Not Found"], 404);
        $Data->update($request->all());
        return response()->json($Data, 200);
    }

    public function destroy($id)
    {
        $Data = Clinic::find($id);
        if (is_null($Data))
            return response()->json(["message" => "404 Not Found"], 404);
        $Data->delete();
        return response()->json(null, 204);
    }
}

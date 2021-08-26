<?php

namespace App\Http\Controllers;

use App\Models\ReservationRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ReservationRequestController extends Controller
{
    public function index()
    {
        return response()->json(ReservationRequest::get(), 200);
    }

    public function store(Request $request)
    {
            $rules = ['reservation_date' => 'required'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
                return response()->json($validator->errors(), 400);
            $reservation = ReservationRequest::create($request->all());
            $reservation->update(["request_type" => "reserve"]);
            $reservation->update(["status" => "pending"]);
            return response()->json($reservation, 201);
    }

    public function show($id)
    {
        $Data = ReservationRequest::find($id);
        if (is_null($Data))
            return response()->json(["message" => "404 Not Found"], 404);
        $Data->clinic;
        $Data->patient;
        return response()->json($Data, 200);
    }


    public function update(Request $request, $id)
    {
        $reservation = ReservationRequest::find($id);
        if (is_null($reservation))
            return response()->json(["message" => "404 Not Found"], 404);
        $reservation->update($request->all());
        if($reservation['request_type']=="reserve") {
            if (is_null($request->input("reservation_time")))
                $reservation->update(["status" => "notOk"]);
            else
                $reservation->update(["status" => "Ok"]);
        }
        return response()->json($reservation, 200);
    }

    public function destroy($id)
    {
        $Data = ReservationRequest::find($id);
        if (is_null($Data))
            return response()->json(["message" => "404 Not Found"], 404);
        $Data->delete();
        return response()->json(null, 204);
    }

    public function cancel(Request $request)
    {
        $clinic_id = $request->input('clinic_id');
        $patient_id = $request->input('patient_id');
        $reservationRequest = ReservationRequest::where(['clinic_Id' => $clinic_id, 'patient_Id' => $patient_id])->get()->first();
        if (is_null($reservationRequest))
            return response()->json(["message" => "404 Not Found"], 404);
        $reservationRequest->delete();
        return response()->json(null, 204);
    }
}

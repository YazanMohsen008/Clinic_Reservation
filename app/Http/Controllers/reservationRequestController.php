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
        if($request->input("request_type")=="Reserve") {
            $rules = ['reservation_date' => 'required'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
                return response()->json($validator->errors(), 400);
            $reservation = ReservationRequest::create($request->all());
            $reservation->update(["status" => "pending"]);
            return response()->json($reservation, 201);
        }
    }

    public function show($id)
    {
        $Data = ReservationRequest::find($id);
        if (is_null($Data))
            return response()->json(["message" => "404 Not Found"], 404);
        $Data->clinic;
        $Data->patient;
        return response()->json(["Reservation Request" => $Data], 200);
    }

    public function update(Request $request, $id)
    {
        $reservation = ReservationRequest::find($id);
        if (is_null($reservation))
            return response()->json(["message" => "404 Not Found"], 404);
        $reservation->update($request->all());
        if (is_null($request->input("reservation_time")))
            $reservation->update(["status" => "notOk"]);
        else
            $reservation->update(["status" => "Ok"]);

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
}

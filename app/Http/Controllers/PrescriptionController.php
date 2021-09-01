<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PrescriptionController extends Controller
{
    public function index()
    {
        return response()->json(Prescription::get(), 200);
    }

    public function storePrescription(array $request)
    {
        $Data = Prescription::create($request);
        $medicineController = new MedicineController();
        $medicines = $request["medicines"];
        foreach ($medicines as $medicine) {
            $medicine["prescription_id"]=$Data["id"];
            $medicineController->storeMedicine($medicine);
        }

        return response()->json($Data, 201);
    }
    public function store(Request $request)
    {
        $Data = Prescription::create($request->all());
        return response()->json($Data, 201);
    }

    public function show($id)
    {
        $Data = Prescription::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->medicines;
        $Data->diagnosis;
        return response()->json($Data, 200);
    }

    public function update(Request $request, $id)
    {
        $Data = Prescription::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->update($request->all());
        return response()->json($Data, 200);
    }

    public function destroy($id)
    {
        $Data = Prescription::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->delete();
        return response()->json(null, 204);
    }


}

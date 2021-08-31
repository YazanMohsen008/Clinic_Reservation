<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class AttachmentController extends Controller
{
    public function index()
    {
        return response()->json(Attachment::get(), 200);

    }

    public function store(Request $request)
    {
        $rules=[
            'name'=>'required|min:3',
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
            return response()->json($validator->errors(),400);
        $Data = Attachment::create($request->all());

        return response()->json($Data, 201);
    }

    public function storeAttachment(array $attachment)
    {
        $Data = Attachment::create($attachment);
        $fileController=new FileController();
        $fileController->upload($attachment);
        return response()->json($Data,201);
    }
    public function show($id)
    {
        $Data = Attachment::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->diagnosis;
        $fileController=new FileController();
        $fileController->download($Data["file_path"]);
        return response()->json($Data, 200);
    }

    public function update(Request $request, $id)
    {
        $Data = Attachment::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->update($request->all());
        return response()->json($Data, 200);
    }

    public function destroy($id)
    {
        $Data = Attachment::find($id);
        if (is_null($Data))
            return response()->json(["message"=>"404 Not Found"], 404);
        $Data->delete();
        return response()->json(null, 204);
    }
}



<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\PhoneNumber;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class FileController extends Controller
{

    public function Download (string $filePath){
        return response()->download(public_path($filePath),"Photo Description");
    }

    public function Upload (array $request){
        $fileName='file'.$request['name'].'.'.$request['type'];
//        $request->file('file')->move(public_path("/"),$fileName);
        $file_url=url('/',$fileName);
        return $file_url;

    }
}


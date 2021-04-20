<?php

namespace App\Http\Controllers\imgBase;

use App\Models\Base;
use Illuminate\Http\Request;
use App\Models\ApplicationType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BaseController extends Controller
{

    //
    public function index()
    {
        $applicationTypes = ApplicationType::all();
        return view('base.form',[
            'applicationTypes'=>$applicationTypes
        ] );
    }

    public function storeFile($file)
    {
        # code...
        $extention = $file->extension();
        $mimeType = $file->getMimeType();
        $path= Storage::disk('do_spaces')->putFileAs('uploads', $file, time().'.'.$extention, 'public');
        dd($path);
        return $path;

    }

    public function showFile()
    {
        # code...
        // $file = Storage::disk('do_spaces')->get('uploads/1618870912.zip');

        $headers = [
            'Content-Type' => 'application/octet-stream'
        ];

        // if (file_exists($fileurl)) {
        //     return Response::download($fileurl, 'Photos.zip', array('Content-Type: application/octet-stream','Content-Length: '. filesize($fileurl)))->deleteFileAfterSend(true);
        // } else {
        //     return ['status'=>'zip file does not exist'];
        // }

        $link = env('DO_REPO_LINK');
        return redirect($link.'uploads/1618870755.zip');
    }

    public function storeBase(Request $request)
    {
        //dd($request->file->store('public/uploads'));
        dd($this->storeFile($request->file('file')));
        # code...
        $this->validate($request, [
            'dbname' => 'required|max:50',
            'nbimages' => 'required|numeric|min:0',
            'apptype' => 'required|max:200',
            'references' => 'nullable',
            'classification_rate'=>'min:0|numeric|required',
            'description' => 'nullable',

        ]);

        try {
            //code...
            Base::create([
                'dbname' => $request->dbname,
                'nbimages' => $request->nbimages,
                'apptype' => $request->apptype,
                'references' => $request->references,
                'description' => $request->description,
                'classification_rate' => $request->classification_rate,
                'application_types_id' => $request->apptype
            ]);
        } catch (Exception $ex) {
            //throw $th;
            return redirect()->back()->with("status", $ex->getMessage());

        }
    }

    public function storeApplicationType(Request $request)
    {
        # code...
        $response = null;
        $app;
        try {
            $app = ApplicationType::create([
                'application_name' => $request->appName,           
            ]);
            $response = array(
                'status' => 'success',
                'msg' => $request->message,
                'data' => $app
            );
            return response()->json($response); 
        } catch (Exception $ex) {

            return response()->json($ex->getMessage());

        }
    }
}

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

    public function uploadBase(Request $request)
    {
        # code...
        $file = $request->file('file');
        $extention = $file->extension();
        $mimeType = $file->getMimeType();
        $path= Storage::disk('do_spaces')->putFileAs('uploads', $file, time().'.'.$extention, 'public');
        //dd($path);
        $response = array(
            'status' => 'success',
            'path' => $path,
        );
        return response()->json($response); 
        //return $path;

    }

    public function showFile()
    {
      
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
                'application_types_id' => $request->apptype,
                'bdd_img_path' => $request->db_file_name
            ]);
        } catch (Exception $ex) {
            //throw $th;
            return redirect()->back()->with("status", $ex->getMessage());

        }

        return redirect()->to('/');
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

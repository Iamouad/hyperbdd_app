<?php

namespace App\Http\Controllers\imgBase;

use App\Models\Base;
use Illuminate\Http\Request;
use App\Models\ApplicationType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BaseController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
    }

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

    public function deleteBase(Request $request)
    {
        $base = Base::find($request->baseId);
        Storage::disk('do_spaces')->delete($base->bdd_img_path);
        Storage::disk('public')->delete($base->index_img_path);
        Base::destroy($base->id);
        $response = array(
            'status' => 'success',
            'msg' => 'destoyed',
        );
        return response()->json($response); 
    }

    public function showFile(Request $request)
    {
        $link = env('DO_REPO_LINK');
        $path = $request->path;
        return redirect($link.$path);
    }

    public function storeBase(Request $request)
    {
      
        # code...
        $this->validate($request, [
            'dbname' => 'required|max:50',
            'nbimages' => 'required|numeric|min:0',
            'apptype' => 'required|max:100',
            'references' => 'nullable',
            'classification_rate'=>'min:0|numeric|required',
            'description' => 'nullable',
            'indexImg' => 'required|file|image'
        ]);

        try {
            $indexImg = $request->file('indexImg');
            $extention = $indexImg->extension();
            $mimeType = $indexImg->getMimeType();
            Storage::disk('public')->putFileAs('uploads',$indexImg ,$request->dbname.'.'.$extention);
            //code...
            Base::create([
                'dbname' => $request->dbname,
                'nbimages' => $request->nbimages,
                'user_id' => Auth::user()->id,
                'apptype' => $request->apptype,
                'references' => $request->references,
                'description' => $request->description,
                'classification_rate' => $request->classification_rate,
                'application_types_id' => $request->apptype,
                'index_img_path' => 'uploads/'.$request->dbname.'.'.$extention,
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

    public function incrementDownload(Request $request)
    {
        $base = Base::find($request->baseId);
        $base->nb_downloads = $base->nb_downloads + 1;
        $base->save();
        $response = array(
            'status' => 'success',
            'nbDownloads' => $base->nb_downloads,
        );
       
        return response()->json($response); 
    }

    
}

<?php

namespace App\Http\Controllers\imgBase;

use App\Models\Base;
use App\Jobs\DownloadBase;
use App\Mail\BaseUploaded;
use Illuminate\Http\Request;
use App\Models\ApplicationType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        $file = $request->file('fileupload');
        $extention = $file->extension();
        $mimeType = $file->getMimeType();
        $fileName =str_replace(' ', '', $file->getClientOriginalName()) ;
        //upload in the cloud
        //$path = Storage::disk('do_spaces')->putFileAs('uploads/user'.Auth::user()->id, $file, $fileName, 'public');
        //upload in an ftp server
        $path= Storage::disk('eil-ftp')->putFileAs('uploads/user'.Auth::user()->id, $file, $fileName);

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
        Storage::disk('eil-ftp')->delete($base->bdd_img_path);
        Storage::disk('public')->delete($base->index_img_path);
        Base::destroy($base->id);
        $response = array(
            'status' => 'success',
            'msg' => 'destoyed',
        );
        return response()->json($response); 
    }


    public function storeBase(Request $request)
    {
      
        # code...
        $this->validate($request, [
            'dbname' => 'required|max:50',
            'nbimages' => 'required|numeric|min:0',
            'apptype' => 'required|max:100',
            'references' => 'nullable',
            'classification_rate'=>'min:0|max:100|numeric|required',
            'description' => 'nullable',
            'indexImg' => 'required|file|image'
        ]);

        try {
            $indexImg = $request->file('indexImg');
            $extention = $indexImg->extension();
            $mimeType = $indexImg->getMimeType();
            
            /*$myvalue = $request->dbname;
            $arr = explode(' ',trim($myvalue));*/
            //echo $arr[0];

            $time = time();
            Storage::disk('public')->putFileAs('uploads',$indexImg ,$time.'.'.$extention);
            //code...
            $base = Base::create([
                'dbname' => $request->dbname,
                'nbimages' => $request->nbimages,
                'user_id' => Auth::user()->id,
                'apptype' => $request->apptype,
                'references' => $request->references,
                'description' => $request->description,
                'classification_rate' => $request->classification_rate,
                'application_types_id' => $request->apptype,
                'index_img_path' => 'uploads/'.$time.'.'.$extention,
                'bdd_img_path' => $request->db_file_name
            ]);
            Mail::to(Auth::user())->send(new BaseUploaded(Auth::user()->firstname, $base->id));

        } catch (Exception $ex) {
            //throw $th;
            return redirect()->back()->with("status", $ex->getMessage());

        }

        return redirect()->to('/');
    }

    public function findBase(Request $request)
    {
        # code...
        $fileName = str_replace(' ', '',$request->file);
        $file = 'uploads/user'.Auth::user()->id.'/'.$fileName;
        $size = null;
        if(Storage::disk('eil-ftp')->exists($file)){
            $size = Storage::disk('eil-ftp')->size($file);
        }
        $response = array(
            'status' => 'success',
            'size' => $size,
        );
        
        return response()->json($response);
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


    public function baseIndex(Request $request)
    {
        $base = Base::find($request->id);
        if($base){
            return view('base.baseIndex', [
                'base' => $base
            ]);
        }
        return \redirect()->back()->withErrors(["Ressource not found"]);
    }

    public function userBases(Request $request)
    {
        $bases = Base::where('user_id', $request->user_id)->paginate(2);
        if($bases){
            return view('base.userBases', [
                'bases' => $bases
            ]);
        }
        return \redirect()->back()->withErrors(["Ressource not found"]);
    }

    
}

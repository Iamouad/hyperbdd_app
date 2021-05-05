<?php

namespace App\Http\Controllers;

use App\Models\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Queue\ShouldQueue;

class DownloadController extends Controller implements ShouldQueue
{
    //
    public function downloadBase(Request $request)
    {
        # code...
        $base = Base::find($request->baseId);
        $base->nb_downloads = $base->nb_downloads + 1;
        $base->save();
       // $path = env('DO_REPO_LINK').$base->bdd_img_path;
        $dbname = $base->dbname;
        // $response = array(
        //     'status' => 'success',
        //     'nbDownloads' => $base->nb_downloads,
        // );
        // $headers = array(
        //     'Content-Type: application/x-zip',
        //     "Content-Type: application/force-download",
        //     "Content-Type: application/octet-stream",
        //     "Content-Type: application/download",
        //     "Content-Transfer-Encoding: binary "

        //   );

          return Storage::disk('eil-ftp')->download($base->bdd_img_path);

         

       
        //return response()->download($file, 'test.zip', $headers);
    }
}

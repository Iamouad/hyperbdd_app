<?php

namespace App\Http\Controllers;

use App\Models\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Queue\ShouldQueue;
use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;

class DownloadController extends Controller implements ShouldQueue
{
    //
    public function downloadBase(Request $request)
    {
        # code...

        $base = Base::find($request->baseId);
        $base->nb_downloads = $base->nb_downloads + 1;
        $base->save();
        $dbname = $base->dbname;

        // return Storage::disk('eil-ftp')->download($base->bdd_img_path);
        $filesystem = new Filesystem(new SftpAdapter([
          'host' => \env('FTP_HOST'),
          'port' => \env('FTP_PORT'),
          'username' => \env('FTP_USERNAME'),
          'password' => \env('FTP_PASSWORD'),
          'privateKey' => null,
          'root' => \env('FTP_ROOTDIR'),
          'timeout' => 10,
      ]));
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=".$dbname.'.zip');
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        while (ob_get_level()) {
          ob_end_clean();
      }
        // read the file from disk
        echo $filesystem->read($base->bdd_img_path);
        // return response($filesystem->read($base->bdd_img_path))
        // ->header("Cache-Control", "public") 
        // ->header("Content-Description", "File Transfer")
        // ->header("Content-Disposition","attachment; filename=".$dbname.'.zip')
        // ->header("Content-Type", "application/zip")
        // ->header("Content-Transfer-Encoding", "binary");


    }
}

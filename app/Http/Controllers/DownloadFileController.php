<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadFileController extends Controller
{
    public function download()
    {
        // $my_file = storage_path('download/data.pdf');
        // return response()->download($my_file);
        // return back();
        $filePath = public_path("example.php");
        $headers = ['Content-Type: application/php'];
        $fileName = 'example'.'.php';

        return response()->download($filePath, $fileName, $headers);
    }
}

<?php

namespace App\Http\Controllers\Download;

use App\Http\Controllers\Controller;
use App\Services\ZipArchive\ZipService;
use Illuminate\Http\Request;

class ZipController extends Controller
{
    public function removeImagesOlx(Request $request, ZipService $zip) {
        $zip->removeUserFolderZip();

        return response()->json(["message" => "OK"]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CkeditorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload(Request $request)
    {
        $post = $request->all()['upload'];
        if (isset($post)) {
            $filename = $post->getClientOriginalName();
            $filename = Filenameclean($filename);
            $dir = 'upload/';
            $destFilename = $dir . $filename;
            $destFilename = FileAvoidDuplicate($destFilename, Storage::disk('public'));
            Storage::disk('public')->put($destFilename, $post->get());
            return response()->json([
                'url' => '/storage/'.$destFilename
            ]);
        }
        return null;

    }
}

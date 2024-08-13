<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Models\video;
use Illuminate\Http\Request;

class youtubeController extends Controller
{
    public function index(){

        $video = video::first();
        event( new VideoViewer( $video ) );
        return view("Youtube/Youtube")->with("video", $video);
    }
}

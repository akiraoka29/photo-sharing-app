<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Traits\PhotoTrait;
use App\Http\Controllers\Traits\TagTrait;

class HomePageController extends Controller
{
    use PhotoTrait, TagTrait;
    /**
     * Display a homepage
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get Tags
        $tags = $this->showTags();
        $photos = $this->showPhotos();
        // Render
        return view('home', compact('tags','photos'));
    }
}

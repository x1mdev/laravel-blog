<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;

class MediaController extends Controller
{
    public function show(Media $medium)
    {
       return $medium;
    }
}

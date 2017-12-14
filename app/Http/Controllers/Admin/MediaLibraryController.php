<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaLibraryRequest;
use App\MediaLibrary;

class MediaLibraryController extends Controller
{
    /**
     * Return the media library.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.media.index', [
            'media' => MediaLibrary::first()->getMedia()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(MediaLibraryRequest $request)
    {
        MediaLibrary::first()
            ->addMedia($request->file('image'))
            ->toMediaCollection();

        return redirect()->route('admin.media.index')->withSuccess(__('media.created'));
    }
}

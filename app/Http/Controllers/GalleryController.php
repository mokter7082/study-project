<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:gallery-list|gallery-create|gallery-edit|gallery-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:gallery-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:gallery-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:gallery-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $galleries = Gallery::whereIn('status', ['Active', 'Inactive'])->get();       
        return view('backend.gallery.list', compact('galleries'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
       return view('backend.gallery.create'); 
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $this->validate($request, [
            'title' => 'required',  
            'status' => 'required',
        ]);
  
        $gallery = new Gallery;
        $gallery->title           = $request->title;     
        $gallery->excerpt         = $request->excerpt;  
        $gallery->description     = $request->description;   
        $gallery->picture         = $request->picture??Null;   
        $gallery->status          = $request->status;
        $gallery->save(); 
  
        return redirect()->route('galleries.index', $gallery->id)->with('success', 'Gallery created successfully');

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        
        //

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    { 
        
        $data['gallery'] = $gallery;

        return view('backend.gallery.create',  $data);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $this->validate($request, [
            'title' => 'required',  
            'status' => 'required',
        ]);

        $gallery->title         = $request->title;  
        $gallery->excerpt       = $request->excerpt;  
        $gallery->description   = $request->description;    
        $gallery->picture       = $request->picture;  
        $gallery->status        = $request->status; 
        $gallery->save();

        return redirect()->back()->with('success', 'Gallery updated successfully');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->status = 'Delete';
        $gallery->save();

        return redirect()->back()->with('success', 'Gallery items deleted successfully');

    }



}

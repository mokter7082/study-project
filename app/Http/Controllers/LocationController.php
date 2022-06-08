<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:location-list|location-create|location-edit|location-delete', ['only' => ['index','store']]);
        $this->middleware('permission:location-create', ['only' => ['create','store']]);
        $this->middleware('permission:location-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:location-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::whereIn('status', ['Active','Inactive'])->get();
        return view('backend.locations.list')->with('locations', $locations); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::whereIn('status', ['Active','Inactive'])->get();   
        return view('backend.locations.create', compact('locations'));
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

        $input = $request->except('_token');   

        Location::create($input);

        return back()->with('success', 'New Location added successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    { 
        $locations = Location::whereIn('status', ['Active','Inactive'])->get();   
        return view('backend.locations.create',compact('locations','location'));
    }

    /***
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $this->validate($request, [
            'title' => 'required', 
            'status' => 'required',
        ]);
         
        $location->title         = $request->title;  
        $location->description   = $request->description;           
        $location->status        = $request->status;  
        $location->save();      
        
        return redirect()->back()->with('success','Location updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {     

        // dd("hitted");
         
        $oldImg = $location->picture;
        if (!empty($oldImg)) {
          Storage::delete($location->picture); 
        }
         
        $location->delete();//delete row
        return redirect()->back()->with('success','Course type deleted successfully');
    }
}

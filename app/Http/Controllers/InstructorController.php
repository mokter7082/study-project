<?php

namespace App\Http\Controllers;

use App\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:instructor-list|instructor-create|instructor-edit|instructor-delete', ['only' => ['index','store']]);
        $this->middleware('permission:instructor-create', ['only' => ['create','store']]);
        $this->middleware('permission:instructor-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:instructor-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = Instructor::whereIn('status', ['Active','Inactive'])->get();
        return view('backend.instructors.list')->with('instructors', $instructors); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instructors = Instructor::whereIn('status', ['Active','Inactive'])->get();   
        return view('backend.instructors.create', compact('instructors'));
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
            'name' => 'required', 
            'status' => 'required',
        ]);
        
        $instructor = new Instructor;

        $instructor->name = $request->name;
        $instructor->picture = $request->picture;
        $instructor->description = $request->description;
        $instructor->status = $request->status; 
        $instructor->save();

        return back()->with('success', 'New instructor added successfully.');
    }

     

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit(Instructor $instructor)
    {
        $instructors = Instructor::whereIn('status', ['Active','Inactive'])->get();   
        return view('backend.instructors.create',compact('instructors','instructor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructor $instructor)
    {
        $this->validate($request, [
            'title' => 'required', 
            'status' => 'required',
        ]);
         
        $instructor->title         = $request->title;  
        $instructor->description   = $request->description;           
        $instructor->status        = $request->status;  
        $instructor->save();      
        
        return redirect()->back()->with('success','Instructor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        $oldImg = $instructor->picture;
        if (!empty($oldImg)) {
          Storage::delete($instructor->picture); 
        }
         
        $instructor->delete();//delete row
        return redirect()->back()->with('success','Instructor deleted successfully');
    }
}

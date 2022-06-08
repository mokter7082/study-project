<?php

namespace App\Http\Controllers;

use App\Widget;
use Illuminate\Http\Request;
use DB;
use OmeLabHelper;  

class WidgetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:widget-list|widget-create|widget-edit|widget-delete', ['only' => ['index','store']]);
        $this->middleware('permission:widget-create', ['only' => ['create','store']]);
        $this->middleware('permission:widget-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:widget-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $widgets = Widget::whereIn('status',['Active','Inactive'])->get();       
        return view('backend.widgets.list', compact('widgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('backend.widgets.create');
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
            'referance'=>'unique:widgets,referance',  
            'description' => 'required',
            'status' => 'required',
        ]);
  
        $widget = new Widget;
        $widget->title                = $request->title;  
        $widget->referance            = $request->referance;  
        $widget->description          = $request->description;  
        $widget->status               = $request->status;
    
        /*if($request->hasFile('picture')) {
            $this->validate($request, [
                'picture' => 'required|image|mimes:jpeg,png,jpg|max:1024', 
            ]);

            $file = $request->file('picture');  
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $request->file('picture')->storeAs('uploads', $fileName, 'public'); 
            $widget->picture = $filePath;  
        }*/ 
 
        $widget->save(); 

        return redirect()->back()->with('success','Widget created successfully');
    }

 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function edit(Widget $widget)
    {  
        return view('backend.widgets.create',  compact('widget'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Widget $widget)
    {
        $this->validate($request, [
            'referance' => 'required',  
            'description' => 'required',  
            'status' => 'required',
        ]);

        $widget->title                = $request->title;  
        $widget->referance            = $request->referance;  
        $widget->description          = $request->description;   
        $widget->status               = $request->status;
    
        /*if($request->hasFile('picture')) {
            $this->validate($request, [
                'picture' => 'required|image|mimes:jpeg,png,jpg|max:1024', 
            ]);

            $file = $request->file('picture');  
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $request->file('picture')->storeAs('uploads', $fileName, 'public'); 
            $page->picture = $filePath;  
        } 
        */

        $widget->save(); 
 
        return redirect()->back()->with('success','Widget updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Widget $widget)
    {
        $widget->status = 'Delete';
        $widget->save();
        return redirect()->back()->with('success','Widget items deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Ctype;
use Illuminate\Http\Request;
use App\Meta; 
class CtypeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:course-type-list|course-type-create|course-type-edit|course-type-delete', ['only' => ['index','store']]);
        $this->middleware('permission:course-type-create', ['only' => ['create','store']]);
        $this->middleware('permission:course-type-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:course-type-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ctypes = Ctype::whereIn('status', ['Active','Inactive'])->orderByRaw('-sort_order desc')->get();
        return view('backend.ctypes.list')->with('ctypes', $ctypes); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ctypes = Ctype::whereIn('status', ['Active','Inactive'])->get();   
        return view('backend.ctypes.create', compact('ctypes'));
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
  
        $ctype = new Ctype;
        $ctype->title                = $request->title;  
        $ctype->sort_order           = $request->sort_order;  
        $ctype->description          = $request->description;   
        $ctype->picture              = $request->picture??Null;   
        $ctype->status               = $request->status;

        $ctype->save();

        if (!empty($request->meta_title) || !empty($request->meta_description) ) { 
            $meta = new Meta;
            $meta->referance_id = $ctype->id;
            $meta->referance = 'ctypes';
            $meta->meta_title = $request->meta_title;
            $meta->meta_description = $request->meta_description;
            $meta->meta_key = $request->meta_key;
            $meta->save(); 
        } 

         return redirect() ->route('course-types.edit',$ctype->id) ->with('success','Course types added successfully'); 
    }

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ctype  $ctype
     * @return \Illuminate\Http\Response
     */
    public function edit(Ctype $ctype, $id)
    { 
        $ctype = Ctype::find($id);
        //$ctypes = Ctype::whereIn('status', ['Active','Inactive'])->get();   
        return view('backend.ctypes.create',compact('ctype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ctype  $ctype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $ctype = Ctype::findOrFail($id);

        $this->validate($request, [
            'title' => 'required',  
            'status' => 'required',
        ]);

        $ctype->title           = $request->title;  
        $ctype->sort_order      = $request->sort_order;  
        $ctype->description     = $request->description;    
        $ctype->picture         = $request->picture;  
        $ctype->status          = $request->status;
        $ctype->save(); 

        //Meta sync
        if (!empty($request->meta_title) || !empty($request->meta_description) ) { 
            $meta = isset($ctype->meta->id) ? Meta::findOrFail($ctype->meta->id) : new Meta;
            $meta->referance_id = $ctype->id;
            $meta->referance = 'ctypes';
            $meta->meta_title = $request->meta_title;
            $meta->meta_description = $request->meta_description;
            $meta->meta_key = $request->meta_key;
            $meta->save(); 
        }  
        return redirect()->back()->with('success','Course types updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ctype  $ctype
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ctype = Ctype::findOrFail($id);
        $ctype->status = 'Delete';
        $ctype->save();  
        return redirect()->back()->with('success','Course type deleted successfully');
    }
}

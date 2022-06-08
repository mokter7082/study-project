<?php

namespace App\Http\Controllers;

use App\Equipments; 
use Illuminate\Http\Request;
use App\Meta;
use App\Category;
use App\Instructor;
use App\Ctype;
use App\Schedule;
use DB;
use OmeLabHelper; 

class EquipmentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('permission:equipments-list|equipments-create|pagequipmentse-edit|equipments-delete', ['only' => ['index','store']]);
        // $this->middleware('permission:equipments-create', ['only' => ['create','store']]);
        // $this->middleware('permission:equipments-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:equipments-delete', ['only' => ['destroy']]);
    }


/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipments = Equipments::whereIn('status',['Active','Inactive'])->orderByRaw('-id asc')->get(); 
        //  dd($equipments);

        return view('backend.courses.list', compact('equipments')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd("ttt");
        $data['categories'] = Category::where('status', 'Active')->pluck('title', 'id'); 
        //$data['allCategories'] = OmeLabHelper::Nested($cats);  

        $data['ctypes'] = Ctype::where('status', 'Active')->pluck('title', 'id'); 
        $data['instructors'] = Instructor::where('status', 'Active')->pluck('name', 'id'); 
        //  dd($data);
        return view('backend.courses.create',  $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->all());
        $this->validate($request, [
            // 'title' => 'required',
            // 'start_time' => 'required',
            // 'end_time' => 'required',
            // 'available_date' => 'required',
            // 'close_date' => 'required',
            // 'single_price' => 'required',
            // 'week' => 'required',
            // 'status' => 'required',
        ]);

        $equipments = new Equipments;
        $equipments->title            = $request->title;  
        $equipments->slug             =  "slug"; 
        $equipments->picture          = $request->picture;  
        $equipments->excerpt          = "https"; 
        $equipments->description      = "description"; 
        $equipments->price_30         = $request->price_for_30_days;   
        $equipments->price_15         = $request->price_for_15_days;
        $equipments->price_7          = $request->price_for_7_days;
        $equipments->price_per_day    = $request->price_for_1_days; 
        $equipments->fooding_cost     = $request->operator_fooding_cost;   
        $equipments->avg_30           = $request->avarage_for_30_days;
        $equipments->avg_15           = $request->avarage_for_15_days;
        $equipments->avg_7            = $request->avarage_for_7_days;
        $equipments->category_id        = $request->category_id;
        $equipments->status           = $request->status;  
        $equipments->save();


     

        //Dlete old schedule date
     

   

         
        //Meta sync
        // if (!empty($request->meta_title) || !empty($request->meta_description) ) { 
        //     $meta = isset($equipments->meta->id) ? Meta::findOrFail($equipments->meta->id) : new Meta;
        //     $meta->referance_id = $equipments->id;
        //     $meta->referance = 'equipments';
        //     $meta->meta_title = $request->meta_title;
        //     $meta->meta_description = $request->meta_description;
        //     $meta->meta_key = $request->meta_key;
        //     $meta->save(); 
        // } 
  
        return redirect()->back()->with('success','equipments created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\equipments  $equipments
     * @return \Illuminate\Http\Response
     */
    public function show(equipments $equipments)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipments  $equipments
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipments $equipment)
    {  
        $cats = Category::where('parent_id', '=', 1)->get();
        $categories  = OmeLabHelper::Nested($cats); 
        return view('backend.courses.create', compact('equipment','categories')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\equipments  $equipments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, equipments $equipments)
    { 
        $this->validate($request, [
            // 'title' => 'required',  
            // 'start_time' => 'required',
            // 'end_time' => 'required',
            // 'available_date' => 'required',
            // 'close_date' => 'required',
            // 'single_price' => 'required',
            // 'week' => 'required',
            // 'status' => 'required',
        ]);

        $equipments->title            = $request->title;  
        $equipments->slug             =  "slug"; 
        $equipments->picture          = $request->picture;  
        $equipments->excerpt          = "https"; 
        $equipments->description      = "description"; 
        $equipments->price_30         = $request->price_for_30_days;   
        $equipments->price_15         = $request->price_for_15_days;
        $equipments->price_7          = $request->price_for_7_days;
        $equipments->price_per_day    = $request->price_for_1_days; 
        $equipments->fooding_cost     = $request->operator_fooding_cost;   
        $equipments->avg_30           = $request->avarage_for_30_days;
        $equipments->avg_15           = $request->avarage_for_15_days;
        $equipments->avg_7            = $request->avarage_for_7_days;
        $equipments->category_id        = $request->category_id;
        $equipments->status           = $request->status; 
        $equipments->save();


        //cagetory sync 
        // $ctypes = $request->input('ctypes'); 
        // $equipments->ctypes()->sync($ctypes, true); 


        //cagetory sync 
        // $instructors = $request->input('instructors'); 
        // $equipments->instructors()->sync($instructors, true); 


        //Dlete old schedule date
        // Schedule::where('equipments_id', $equipments->id)->delete(); 

        //Insert New schedule date
        // if (!empty($equipments->available_date) && !empty($equipments->close_date)) { 
        //     $dayDiff = dateDiffInDays($equipments->available_date, $equipments->close_date);  
        //     $schedule = [];
        //     for ($i=0; $i < $dayDiff; $i++) { 
        //         $sch_date = date('Y-m-d', strtotime($equipments->available_date . "+$i day")); 
        //         $weekdAy = date("D", strtotime($sch_date)); 
        //         if (in_array($weekdAy, $request->week)) { 
        //             $schedule[] = array(
        //                 'equipments_id'=> $equipments->id,
        //                 'start_at'=> $sch_date
        //             );
        //         } 
        //     } 
        //     DB::table('schedules')->insert($schedule);  
        // }

         
        //Meta sync
        // if (!empty($request->meta_title) || !empty($request->meta_description) ) { 
        //     $meta = isset($equipments->meta->id) ? Meta::findOrFail($equipments->meta->id) : new Meta;
        //     $meta->referance_id = $equipments->id;
        //     $meta->referance = 'equipments';
        //     $meta->meta_title = $request->meta_title;
        //     $meta->meta_description = $request->meta_description;
        //     $meta->meta_key = $request->meta_key;
        //     $meta->save(); 
        // } 
 
        return redirect()->back()->with('success','equipments updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipments  $equipments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipments $equipment)
    {
        //   dd($equipment->id);
        $equipment->status = 'Delete';
        $equipment->save();
        return redirect()->back()->with('success','equipments items deleted successfully');
    }


}

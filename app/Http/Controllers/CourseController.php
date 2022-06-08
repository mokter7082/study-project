<?php

namespace App\Http\Controllers;

use App\Course; 
use Illuminate\Http\Request;
use App\Meta;
use App\Category;
use App\Instructor;
use App\Ctype;
use App\Schedule;
use DB;
use OmeLabHelper; 

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:course-list|course-create|pagcoursee-edit|course-delete', ['only' => ['index','store']]);
        $this->middleware('permission:course-create', ['only' => ['create','store']]);
        $this->middleware('permission:course-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:course-delete', ['only' => ['destroy']]);
    }


/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::whereIn('status',['Active','Inactive'])->orderByRaw('-id asc')->get(); 
        return view('backend.courses.list', compact('courses')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        dd($request);
        $this->validate($request, [
            'title' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'available_date' => 'required',
            'close_date' => 'required',
            'single_price' => 'required',
            'week' => 'required',
            'status' => 'required',
        ]);

        $course = new Course;
        $course->title            = $request->title;  
        $course->start_time       = $request->start_time;  
        $course->end_time         = $request->end_time; 
        $course->clss_duration    = $request->clss_duration; 
        $course->available_date   = date('Y-m-d', strtotime($request->available_date)); 
        $course->close_date       = date('Y-m-d', strtotime($request->close_date));   
        $course->week_days        = implode(',', $request->week); 
        $course->location_id      = $request->location_id; 
        $course->single_price     = $request->single_price; 
        $course->pair_price       = $request->pair_price;   
        $course->description      = $request->description;
        $course->excerpt          = $request->excerpt;
        $course->picture          = $request->picture;
        $course->seat             = $request->seat;
        $course->status           = $request->status;  
        $course->save();


        //cagetory sync 
        $ctypes = $request->input('ctypes'); 
        $course->ctypes()->sync($ctypes, true); 


        //cagetory sync 
        $instructors = $request->input('instructors'); 
        $course->instructors()->sync($instructors, true); 


        //Dlete old schedule date
        Schedule::where('course_id', $course->id)->delete(); 

        //Insert New schedule date
        if (!empty($course->available_date) && !empty($course->close_date)) { 
            $dayDiff = dateDiffInDays($course->available_date, $course->close_date);  
            $schedule = [];
            for ($i=0; $i < $dayDiff; $i++) { 
                $sch_date = date('Y-m-d', strtotime($course->available_date . "+$i day")); 
                $weekdAy = date("D", strtotime($sch_date)); 
                if (in_array($weekdAy, $request->week)) { 
                    $schedule[] = array(
                        'course_id'=> $course->id,
                        'start_at'=> $sch_date
                    );
                } 
            } 
            DB::table('schedules')->insert($schedule);  
        }

         
        //Meta sync
        if (!empty($request->meta_title) || !empty($request->meta_description) ) { 
            $meta = isset($course->meta->id) ? Meta::findOrFail($course->meta->id) : new Meta;
            $meta->referance_id = $course->id;
            $meta->referance = 'course';
            $meta->meta_title = $request->meta_title;
            $meta->meta_description = $request->meta_description;
            $meta->meta_key = $request->meta_key;
            $meta->save(); 
        } 
  
        return redirect()->back()->with('success','Course created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $data['locations'] = Location::where('status', 'Active')->pluck('title', 'id'); 
        //$data['allCategories'] = OmeLabHelper::Nested($cats);  

        $data['ctypes'] = Ctype::where('status', 'Active')->pluck('title', 'id'); 
        $data['instructors'] = Instructor::where('status', 'Active')->pluck('name', 'id'); 
        $data['course'] = $course;

        return view('backend.courses.create',  $data); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    { 
        $this->validate($request, [
            'title' => 'required',  
            'start_time' => 'required',
            'end_time' => 'required',
            'available_date' => 'required',
            'close_date' => 'required',
            'single_price' => 'required',
            'week' => 'required',
            'status' => 'required',
        ]);

        $course->title            = $request->title;  
        $course->start_time       = $request->start_time;  
        $course->end_time         = $request->end_time; 
        $course->clss_duration    = $request->clss_duration; 
        $course->available_date   = date('Y-m-d', strtotime($request->available_date)); 
        $course->close_date       = date('Y-m-d', strtotime($request->close_date));
        $course->week_days        = implode(',', $request->week); 
        $course->location_id      = $request->location_id; 
        $course->single_price     = $request->single_price; 
        $course->pair_price       = $request->pair_price; 
        $course->seat             = $request->seat;  
        $course->description      = $request->description;
        $course->excerpt          = $request->excerpt;
        $course->picture          = $request->picture;
        $course->status           = $request->status;  
        $course->save();


        //cagetory sync 
        $ctypes = $request->input('ctypes'); 
        $course->ctypes()->sync($ctypes, true); 


        //cagetory sync 
        $instructors = $request->input('instructors'); 
        $course->instructors()->sync($instructors, true); 


        //Dlete old schedule date
        Schedule::where('course_id', $course->id)->delete(); 

        //Insert New schedule date
        if (!empty($course->available_date) && !empty($course->close_date)) { 
            $dayDiff = dateDiffInDays($course->available_date, $course->close_date);  
            $schedule = [];
            for ($i=0; $i < $dayDiff; $i++) { 
                $sch_date = date('Y-m-d', strtotime($course->available_date . "+$i day")); 
                $weekdAy = date("D", strtotime($sch_date)); 
                if (in_array($weekdAy, $request->week)) { 
                    $schedule[] = array(
                        'course_id'=> $course->id,
                        'start_at'=> $sch_date
                    );
                } 
            } 
            DB::table('schedules')->insert($schedule);  
        }

         
        //Meta sync
        if (!empty($request->meta_title) || !empty($request->meta_description) ) { 
            $meta = isset($course->meta->id) ? Meta::findOrFail($course->meta->id) : new Meta;
            $meta->referance_id = $course->id;
            $meta->referance = 'course';
            $meta->meta_title = $request->meta_title;
            $meta->meta_description = $request->meta_description;
            $meta->meta_key = $request->meta_key;
            $meta->save(); 
        } 
 
        return redirect()->back()->with('success','Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->status = 'Delete';
        $course->save();
        return redirect()->back()->with('success','Course items deleted successfully');
    }
}

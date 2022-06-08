<?php

namespace App\Http\Controllers;

use App\Quotation; 
use App\Equipments; 
use Illuminate\Http\Request; 
use App\Category;
use App\Meta; 
use DB;
use OmeLabHelper;  

class QuotationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index','store']]);
    //     $this->middleware('permission:post-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $quotations = Quotation::whereIn('status',['Active','Inactive'])->get(); 
        // $equipments = Equipments::whereIn('status',['Active','Inactive'])->orderByRaw('-id asc')->get();   
       $equipments=  DB::table("equipments")->where('status', 'Active')->get(); 
        return view('backend.quotation.list', compact('quotations','equipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('backend.quotation.create');
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
  
        $quotation = new Quotation;
        $quotation->title                = $request->title;  
        $quotation->excerpt              = $request->excerpt;  
        $quotation->description          = $request->description;  
        $quotation->post_template        = $request->post_template;
        $quotation->picture              = $request->picture??Null;   
        $quotation->status               = $request->status;
        $quotation->save();  
  
        return redirect()->route('posts.edit',$quotation->id)->with('success','Quotation created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quotation  $quatation
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
         

        $data['templates'] = DB::table('templates')->where('template_for', 'post')->where('status', 'Active')->pluck('title','slug');
        $data['post'] = $post; 
       
        return view('backend.posts.create',  $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        $this->validate($request, [
            'title' => 'required',  
            'status' => 'required',
        ]);

        $post->title                = $request->title;  
        $post->excerpt              = $request->excerpt;  
        $post->description          = $request->description;  
        $post->post_template        = $request->post_template;  
        $post->picture              = $request->picture;  
        $post->status               = $request->status; 
        $post->save();

         
 
        return redirect()->back()->with('success','Quotation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        $post->status = 'Delete';
        $post->save();
        return redirect()->back()->with('success','Quotation items deleted successfully');
    }
    public function getEqvData(Request $request){

        //GET DATA FROM REQUIEST
        $eqv_id = $request->equivmentId;
        $location = $request->location;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $countDate = dateDiffInDays($start_date, $end_date);
       // GET EQUIPMENT DETAILS

        $eqv_details = DB::table("equipments")
                       ->where("id", $eqv_id)
                       ->first();
        $convertInt = (int)$eqv_details->price_per_day;
        $totalAmount =  ((int)$countDate * $convertInt);
        $final_data = array();
        $final_data["id"] =  $eqv_id;
        $final_data["title"] =  $eqv_details->title;
        $final_data["stander_price"] =  $eqv_details->price_30;
        $final_data["working_days"] =  $countDate+1;
        $final_data["price_per_day"] =  $totalAmount;
        $final_data["operator_fooding_cost"] =  $eqv_details->fooding_cost;
        $final_data["insallation_cost"] =  "At Actual";
        $final_data["start_date"] =  $start_date;
        $final_data["end_date"] =  $start_date;
        $final_data["location"] =  $location;
        $final_data["status"] =  $eqv_details->status;
       $returnHTML = view('backend.quotation.view')->with('eqv_data', $final_data)->render();
        
        return response()->json([
            'status' => 2001,
            'data' => $returnHTML
        ]);
    }
}

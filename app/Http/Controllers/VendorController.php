<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vendor;
use OmeHelper; // Important

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:vendor-list|vendor-create|vendor-edit|vendor-delete', ['only' => ['index','show']]);
        $this->middleware('permission:vendor-create', ['only' => ['create','store']]);
        $this->middleware('permission:vendor-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:vendor-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::latest()->paginate(5);
        return view('vendors.index',compact('vendors'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', 
            'mobile' => 'required|unique:vendors|max:155',
            'email' => 'required|unique:vendors|max:155',
            'address' => 'required',
            'contact_person' => 'required',
            'cp_number' => 'required',
            'bank' => 'required',
            'bank_branch' => 'required',
            'ac_number' => 'required', 
            'status' => 'required',
        ]); 

        $input = $request->all();

        $input['vc_code'] = keg_generate('vendor', 'v-');
 
        if($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:1000',
            ]); 
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('img'), $imageName);
            $input['image']= $imageName; 
        }

        $vendor = Vendor::create($input);

        return redirect()->route('vendors.index')
            ->with('success','vendors created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show(Vendor $vendor)
    {
         return view('vendors.show',compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        return view('vendors.create',compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
 
        $request->validate([
            'name' => 'required', 
            'mobile' => 'required|unique:vendors,mobile,'.$vendor->id.'|max:155', 
            'email' => 'required|unique:vendors,email,'.$vendor->id.'|max:155',
            'address' => 'required',
            'contact_person' => 'required',
            'cp_number' => 'required',
            'bank' => 'required',
            'bank_branch' => 'required',
            'ac_number' => 'required', 
            'status' => 'required',
        ]); 

        $input = $request->all(); 
        //$input['vc_code'] = keg_generate('vendor', 'v-');
        
        if($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:1000',
            ]); 
            $imageName = 'logo-'.time().'.'.$request->image->getClientOriginalExtension(); 
            $request->image->move(public_path('img'), $imageName);
            $input['image'] = $imageName;
        }

        $vendor->update($input);

        return redirect()->route('vendors.index')->with('success','Vendor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        //$vendor->update(['status'=>'Inactive']);
        return redirect()->route('vendors.index')
            ->with('success','Vendor deleted successfully');
    }
}

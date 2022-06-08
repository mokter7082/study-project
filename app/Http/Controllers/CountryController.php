<?php

namespace App\Http\Controllers;
use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*function __construct()
    {
        $this->middleware('permission:country-list|country-create|country-edit|country-delete', ['only' => ['index','show']]);
        $this->middleware('permission:country-create', ['only' => ['create','store']]);
        $this->middleware('permission:country-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:country-delete', ['only' => ['destroy']]);
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::where('status', 'Active')->get();
        return view('backend.countries.index',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('backend.countries.create');
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
            'title' => 'required', 
            'code' => 'required|unique:countries|max:155', 
            'status' => 'required',
        ]); 

        $input = $request->all();  

        $country = Country::create($input);

        return redirect()->route('countries.index')->with('success','Countries created successfully.');
    }

 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('backend.countries.create',compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'title' => 'required',  
            'code' => 'required|unique:countries,code,'.$country->id.'|max:155', 
            'status' => 'required',
        ]);

        $input = $request->all();  
         
        $country->update($input);

        return redirect()->route('countries.index')->with('success','Countries updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete(); 
        return redirect()->route('countries.index')->with('success','Countries deleted successfully');
    }
}

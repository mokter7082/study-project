<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:language-list|language-create|language-edit|language-delete', ['only' => ['index','show']]);
        $this->middleware('permission:language-create', ['only' => ['create','store']]);
        $this->middleware('permission:language-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:language-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::where('status', 'Active')->get();       
        return view('backend.languages.list')->with('languages', $languages);
    }

 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.languages.create');
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
            'referance'=>'required|unique:languages,referance',
            'en_text' => 'required|unique:languages,en_text',
            'ger_text' => 'required|unique:languages,ger_text',
            'status' => 'required',
        ]); 

        if (Language::where('referance', omeSlugify($request->referance))->first()) {
            return redirect()->back()->with('error','Referance already exist')->withInput(); 
        }

        $language =  new Language;
        $language->referance = omeSlugify($request->referance);
        $language->en_text = $request->en_text;
        $language->ger_text = $request->ger_text;
        $language->status = $request->status;
        $language->save(); 

        return redirect()->route('languages.index')->with('success','Referance added on language successfully'); 
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        $language =  Language::findOrFail($request->ref_id);
        $language->en_text = $request->en_text;
        $language->ger_text = $request->ger_text;
        $language->status = $request->status;
        $language->save(); 

        return response()->json([
            'status' => 'success'
        ]);
    } 
}

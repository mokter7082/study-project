<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:news-list|news-create|news-edit|news-delete', ['only' => ['index','store']]);
        $this->middleware('permission:news-create', ['only' => ['create','store']]);
        $this->middleware('permission:news-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:news-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $news = News::whereIn('status',['Active','Inactive'])->get();       
        return view('backend.news.list', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.news.create');
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
  
        $news = new News;
        $news->title                = $request->title;     
        $news->excerpt              = $request->excerpt;  
        $news->description          = $request->description;   
        $news->picture              = $request->picture??Null;   
        $news->status               = $request->status;
        $news->save(); 
  
        return redirect()->route('news.edit',$news->id)->with('success','News created successfully');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    { 
        $data['news'] = $news;  
        return view('backend.news.create',  $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
         $this->validate($request, [
            'title' => 'required',  
            'status' => 'required',
        ]);

        $news->title         = $request->title;  
        $news->excerpt       = $request->excerpt;  
        $news->description   = $request->description;    
        $news->picture       = $request->picture;  
        $news->status        = $request->status; 
        $news->save();

        return redirect()->back()->with('success','News updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->status = 'Delete';
        $news->save();
        return redirect()->back()->with('success','News items deleted successfully');
    }
}

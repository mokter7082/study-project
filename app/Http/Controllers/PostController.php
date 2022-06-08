<?php

namespace App\Http\Controllers;

use App\Post; 
use Illuminate\Http\Request; 
use App\Category;
use App\Meta; 
use DB;
use OmeLabHelper;  

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index','store']]);
        $this->middleware('permission:post-create', ['only' => ['create','store']]);
        $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::whereIn('status',['Active','Inactive'])->get();       
        return view('backend.posts.list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Category::where('status', 'Active')->where('parent_id', '=', 0)->get();
        $data['allCategories'] = OmeLabHelper::Nested($cats);

        $data['templates'] = DB::table('templates')->where('template_for', 'post')->where('status', 'Active')->pluck('title','slug'); 
       
        return view('backend.posts.create',  $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',  
            'status' => 'required',
        ]);
  
        $post = new Post;
        $post->title                = $request->title;  
        $post->excerpt              = $request->excerpt;  
        $post->description          = $request->description;  
        $post->post_template        = $request->post_template;
        $post->picture              = $request->picture??Null;   
        $post->status               = $request->status;
        $post->save();


        $categories = $request->input('category');  
        if (!empty($categories)) {
            $post->categories()->sync($categories, false);
        }
 
        if (!empty($request->meta_title) || !empty($request->meta_description) ) { 
            $meta = new Meta;
            $meta->referance_id = $post->id;
            $meta->referance = 'posts';
            $meta->meta_key = $request->meta_key;
            $meta->meta_title = $request->meta_title;
            $meta->meta_description = $request->meta_description; 
            $meta->save(); 
        }  
        return redirect()->route('posts.edit',$post->id)->with('success','Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $cats = Category::where('status', 'Active')->where('parent_id', '=', 0)->get();
        $data['allCategories'] = OmeLabHelper::Nested($cats); 

        $data['templates'] = DB::table('templates')->where('template_for', 'post')->where('status', 'Active')->pluck('title','slug');
        $data['post'] = $post; 
       
        return view('backend.posts.create',  $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // dd($request->all());
        // $this->validate($request, [
        //     'title' => 'required',  
        //     'status' => 'required',
        // ]);

        $post->title                = $request->title;  
        $post->excerpt              = $request->excerpt;  
        $post->description          = $request->description;  
        $post->post_template        = $request->post_template;  
        $post->picture              = $request->picture;  
        $post->status               = $request->status; 
        $post->save();
        // dd("hoise update");

        //cagetory sync
        $categories = $request->input('category');  
        $post->categories()->sync($categories, true); 
        
         //Meta sync
        if (!empty($request->meta_title) || !empty($request->meta_description) ) { 
            $meta = isset($post->meta->id) ? Meta::findOrFail($post->meta->id) : new Meta;
            $meta->referance_id = $post->id;
            $meta->referance = 'posts';
            $meta->meta_title = $request->meta_title;
            $meta->meta_description = $request->meta_description;
            $meta->meta_key = $request->meta_key;
            $meta->save(); 
        } 
 
        return redirect()->back()->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->status = 'Delete';
        $post->save();
        return redirect()->back()->with('success','Post items deleted successfully');
    }
}

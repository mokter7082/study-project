<?php 
namespace App\Http\Controllers;

use App\Page;
use App\Meta; 
use Illuminate\Http\Request;
use DB;
use OmeLabHelper; 

class PageController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:page-list|page-create|page-edit|page-delete', ['only' => ['index','store']]);
        $this->middleware('permission:page-create', ['only' => ['create','store']]);
        $this->middleware('permission:page-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:page-delete', ['only' => ['destroy']]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::whereIn('status',['Active','Inactive'])->get();       
        return view('backend.pages.list', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $pgs = Page::where('status', 'Active')->where('parent_id', '=', 0)->get();
        $data['allPages'] = OmeLabHelper::Nested($pgs);

        $data['templates'] = DB::table('templates')->where('template_for', 'page')->where('status', 'Active')->pluck('title','slug'); 
       
        return view('backend.pages.create',  $data);
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
  
        $page = new Page;
        $page->title                = $request->title;  
        $page->excerpt              = $request->excerpt;  
        $page->description          = $request->description; 
        $page->parent_id            = empty($request->parent_id)?0:$request->parent_id; 
        $page->template             = $request->template; 
        $page->picture              = $request->picture??Null;   
        $page->status               = $request->status;
    
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
        $page->save();

        /*$categories = $request->input('category');  
        if (!empty($categories)) {
            $page->categories()->sync($categories, false);
        }*/
 
        if (!empty($request->meta_title) || !empty($request->meta_description) ) { 
            $meta = new Meta;
            $meta->referance_id = $page->id;
            $meta->referance = 'pages';
            $meta->meta_title = $request->meta_title;
            $meta->meta_description = $request->meta_description;
            $meta->meta_key = $request->meta_key;
            $meta->save(); 
        } 
 
        return redirect() ->route('pages.edit',$page->id) ->with('success','Page created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    { 
        $pgs = Page::where('status', 'Active')->where('parent_id', '=', 0)->where('id', '!=', $page->id)->get();
        $data['allPages'] = OmeLabHelper::Nested($pgs);


        $data['templates'] = DB::table('templates')->where('template_for', 'page')->where('status', 'Active')->pluck('title','slug'); 
        $data['page'] = $page; 
       
        return view('backend.pages.create',  $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $this->validate($request, [
            'title' => 'required',  
            'status' => 'required',
        ]);

        $page->title                = $request->title;  
        $page->excerpt              = $request->excerpt;  
        $page->description          = $request->description; 
        $page->parent_id            = empty($request->parent_id)?0:$request->parent_id;
        $page->template             = $request->template;  
        $page->picture              = $request->picture;  
        $page->status               = $request->status;
    
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
        $page->save();

        //cagetory sync
        /*$categories = $request->input('category');  
        $page->categories()->sync($categories, true); */
        
         //Meta sync
        if (!empty($request->meta_title) || !empty($request->meta_description) ) { 
            $meta = isset($page->meta->id) ? Meta::findOrFail($page->meta->id) : new Meta;
            $meta->referance_id = $page->id;
            $meta->referance = 'pages';
            $meta->meta_title = $request->meta_title;
            $meta->meta_description = $request->meta_description;
            $meta->meta_key = $request->meta_key;
            $meta->save(); 
        } 
 
        return redirect()->back()->with('success','Page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->status = 'Delete';
        $page->save();
        return redirect()->back()->with('success','Page items deleted successfully');
    }
}

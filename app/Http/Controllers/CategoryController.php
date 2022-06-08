<?php 

namespace App\Http\Controllers;

use App\Category; 
use App\Http\Requests; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OmeLabHelper; 
use DB;

class CategoryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','store']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $categories = Category::where('parent_id', '=', 1)->orderByRaw('-sort_order desc')->get();
        // $category = DB::table("categories")->get();

        // dd($categories);
        return view('backend.categories.list')->with('cats', $categories); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Category::where('parent_id', '=', 1)->get();
        $allCategories = OmeLabHelper::Nested($cats); 

        $categories =  Category::where('status', 'Active')->get();
        return view('backend.categories.create', compact('allCategories', 'categories'));
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

        $input = $request->except('_token');
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];  
        $input['slug'] = omeSlug($request->title);   

        if($request->hasFile('picture')) {
            $this->validate($request, [
                'picture' => 'required|image|mimes:jpeg,png,jpg|max:1024', 
            ]);

            $file = $request->file('picture');  
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $request->file('picture')->storeAs('uploads', $fileName, 'public'); 
            $input['picture'] = $filePath;  
        } 
  
        Category::create($input);

        return back()->with('success', 'New Category added successfully.');
    }
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // dd($category->id);
        // get the nerd
        $cats = Category::where('parent_id', '=', 0)->where('id', '!=', $category->id)->get(); 
        $allCategories = OmeLabHelper::Nested($cats);

        $categories = Category::where('parent_id', '=', 0)->get();     

        return view('backend.categories.create',compact('category','categories','allCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    { 
 
        $this->validate($request, [
            'title' => 'required', 
            'status' => 'required',
        ]);
  
        $category->title        = $request->title;          
        $category->sort_order   = $request->sort_order;        
        $category->parent_id    = empty($request->parent_id)?0:$request->parent_id;
        $category->status       = $request->status;  
        $category->picture       = $request->picture;  
        $category->save();   
 

        return redirect()->back()->with('success','Category updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    { 

        $oldImg = $category->picture;
        if (!empty($oldImg)) {
          Storage::delete($category->picture); 
        }
         
        if(count($category->childs)){
            $input = ['parent'=>$category->parent];
            Category::where('parent_id', $id)->update($input);
        }

        $category->delete();//delete row
        return redirect()->route('categories.index')->with('success','category deleted successfully');
    }
}

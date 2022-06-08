<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request; 
use App\Page;
use App\Post;
use App\Ctype;
use App\Course;
use DB;
use Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "menu Management";
    }

    
    /*
     * Menu Mange List
     */
    public function list(Request $request, $id=null){
        $tody = date('Y-m-d');
        $data = [];

        if (!empty($id)){
            $data['nav_item'] = Menu::where('id', $id)->first();
        }

        $data['pages'] = Page::where('status', 'Active')->get();
        $data['posts'] = Post::where('status', 'Active')->get();
        
        $data['ctyps'] = Ctype::select('ctypes.*')
            /*->join('course_ctype', 'course_ctype.ctype_id', 'ctypes.id')
            ->join('courses', 'course_ctype.course_id', 'courses.id')
            ->where('courses.available_date', '<=', $tody )
            ->where('courses.close_date', '>=', $tody)*/
            ->where('ctypes.status', 'Active')
            ->groupBy('ctypes.slug')
            ->get();

        $data['courses'] = Course::with('ctypes')->where('courses.status', 'Active')
            //->where('available_date', '<=', $tody )
            //->where('close_date', '>=', $tody)
            ->get();   

        return view('backend.MenuManager.menu_list', $data);
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $insertArr['name'] = $request->label;
        $insertArr['menu_url'] = $request->link;
        $insertArr['icon_class'] = $request->icon;
        $insertArr['modules_id'] = $request->modules_id;
        $insertArr['menu_description'] = $request->menu_description;
        $insertArr['target'] = $request->target;
        $insertArr['status'] = $request->status;

        if (isset($request->menu_id) && $request->menu_id !=''){
            $insertArr['updated_by'] =  Auth::id();
            $insertArr['updated_at'] =  currentDateTime();
            if (Menu::where('id', $request->menu_id)->update($insertArr)){
                return redirect()->back()->with('succ_msg', 'Menu Item Update successfully');
            }
        }else{
            $insertArr['created_by'] =  Auth::id();
            $insertArr['created_at'] =  currentDateTime();
            if (Menu::insert($insertArr)){
                return redirect()->back()->with('succ_msg', 'Create menu item successfully');
            }
        }
        return redirect()->back()->with('error', 'Something wrong please try again');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function items(Request $request){ 
        $data =[];   
        $nav = Menu::select(
                'id',
                'modules_id',
                'name',
                'parent_id',
                'sort_number',
                'menu_url',
                'icon_class',
                'menu_description',
                'target',
                'status'
            )
            ->where('status', 'Active')
            ->where('modules_id', $request->module)
            ->orderBY('sort_number', 'ASC')
            ->get(); 
 
        $data = self::buildTree($nav,0);
 
        if($data ){
            return response()->json(['data'=> $data, 'status'=>'success']);
        }
        
        return response()->json(['status'=>'error']);
    }


    /**
     * Build Tree Menu 
     * @param  $menuObject, $parent item 
     */
    static function buildTree($elements, $parentId = 0){
        $navarr = array();
        foreach ($elements as $element) {
            if ($element->parent_id == $parentId) {
                $children = self::buildTree($elements, $element->id);
                if ($children) {
                    $element->children = $children;
                }
                $navarr[] = $element;
            }
        }
        return $navarr;
    }


    /*
     * Get Single Items
     */
    public function menuItem(Request $request){
        $data=Menu::where('id', $request->id)->first();
        return response()->json([
            'data' => $data,
            'status' => 'success'
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */ 
    public function saveMenuOrder(Request $request){
        if (isset($request->menus) && !empty($request->menus)){
            self::updateRecursive($request->menus);
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }


    //recursive function for update
    static function updateRecursive($data,$parent=0){
        foreach($data as $key =>$item) { 
            $updteArr = [];
            $updteArr['menu_type'] = $parent==0?'Main':'Sub';
            $updteArr['parent_id'] = $parent;
            $updteArr['sort_number'] = $key;

            //Update order
            Menu::where('id', $item['id'])->update($updteArr);

            //Call Recursive method
            if (isset($item['children']) && !empty($item['children'])){
                self::updateRecursive($item['children'], $item['id']);
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */ 
    public function destroyItem(Request $request){
        $delItem = Menu::where('id', $request->id)->first();
        Menu::where('id', $request->id)->update(['status'=>'Inactive']);
        Menu::where('parent_id', $request->id)->update(['parent_id'=>$delItem->parent_id]);
        return response()->json([
            'status' => 'success'
        ]);
    } 

}

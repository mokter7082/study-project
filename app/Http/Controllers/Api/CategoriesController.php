<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;
use DB;

class CategoriesController extends Controller
{
    public function index()
    {
 
        $categoryList = Category::with('equipments')->where("parent_id",0)->get(); 
        return response()->json([
            'status' => 2001,
            'categoriesData' => $categoryList
        ]);
    }
}

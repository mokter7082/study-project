<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class EquipmentsController extends Controller
{
    public function index()
    {
        $id = $_GET['id'];
        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
        $equipment = DB::table("equipments")
                    ->where('id',$id)
                    ->first();
         $equipment= array();
        
      if($equipment){
        return response()->json([
            'status' => 2001,
            'equipment' => $equipment
        ]);
      }else{
        return response()->json([
            'status' => 404,
            'equipment' => "No data found"
        ]);
      }
       
    }
}

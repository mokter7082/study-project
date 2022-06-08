<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;
use DB;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        return self::create($request);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $settings = Settings::where('status', 'Active')->get();  
        $data=[]; 
        foreach ($settings as  $item) {
           $data[$item->referance] = $item;
        }
        $data['languages'] = array(
            'en'=>'English',
            'ger'=>'Germany',
        );
        return view('backend.settings.create', $data);
    }

 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $inputAll = $request->except('_token');  

        foreach ($inputAll as $key => $value) {
            if($value !=''){
                $cstyle = Settings::where('referance', $key)->first();

                if($cstyle){

                    // if($key=='logo'){

                    //     if($request->hasFile('logo')) {
                    //         $this->validate($request, [
                    //             'logo' => 'required|image|mimes:jpeg,png,jpg|max:10000',
                    //         ]);
                    //         $imageName = time().'-logo-.'.$request->logo->getClientOriginalExtension();
                    //         $request->logo->move(public_path('images'), $imageName);
                    //         $cstyle->value = $imageName;
                    //     }  

                    // } else

                    if($key=='custom_style'){ 
                        $cstyle->long_text = $value; 
                    }else{ 
                        $cstyle->value =  $value; 
                    } 
                    
                    $cstyle->save();

                }else{

                    /*if($key=='logo'){

                        $input = array(
                            'referance' =>$key, 
                            'status' =>'Active', 
                        );

                        if($request->hasFile('logo')) {
                            $this->validate($request, [
                                'logo' => 'required|image|mimes:jpeg,png,jpg|max:10000',
                            ]);
                            $imageName = time().'-logo-.'.$request->logo->getClientOriginalExtension();
                            $request->logo->move(public_path('images'), $imageName);
                            $input['value'] = $imageName;
                        }  
 
                    } else*/

                    if($key=='custom_style'){
                       //store custom css
                        $input = array(
                            'referance' =>$key, 
                            'long_text' =>$request->custom_style,
                            'status' =>'Active', 
                        );
                    }else{
                        $input = array(
                            'referance' =>$key, 
                            'value' => $value,
                            'status' =>'Active', 
                        );
                    }

                    Settings::create($input); 
                }
            }
        } 

        //set language session
        setLanguage();

        //call language text getlantext('login');

        return back()->with('success','Settings Updated successfully.'); 

    }


     /* check fi exist */
    public function checkExist(Request $request)
    { 
        $val = isset($request->slugify)?omeSlugify($request->value):$request->value;

        $exist_sql = DB::table($request->table)->where($request->field, $val);

        if(!empty($request->exist)){
            $exist_sql->where('id', '!=', $request->exist);
        }
        
        $exist = $exist_sql->first();  
 
        if ($exist) {
           return response()->json(['status' => 'errors']);
        } 

        return response()->json(['status' => 'success']);
    }
 
}

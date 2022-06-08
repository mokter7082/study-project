<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use OmeHelper;
use App\Country;
use Illuminate\Support\Facades\Hash; 
// use guzzle http lib
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Crypt;


class UserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index',compact('users'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

 
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::where('status', 'Active')->pluck('title','code');
        return view('users.create',compact('countries'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [ 
            'anrede' => 'required',
            'first_name' => 'required|min:3|max:50',
            'address' => 'required',
            'email'=> 'required|email|unique:users,email',  
            'password' => 'required|confirmed|min:6',  
            'zip' =>'required',
            'city' =>'required',
            'phone' =>'required',
            'policy' =>'required', 
        ]); 

        //$code = Str::random(8);
        $input = $request->all();
        //$input['varification_code'] = $code;
        $input['password'] = Hash::make($request->password);
        $input['name'] = $request->anrede . '  '. $request->first_name. '  '. $request->last_name; 
        $input['verified'] = 1; 


        if($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:1024', 
            ]);  
            $file = $request->file('image');  
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public'); 
            $input['image'] = $filePath;  
        }
 

        //Insert User Information
        $user = User::create($input); 
        //$link = url('/verify-account').'/'. base64_encode($user->email.'#*#'.$user->varification_code);
  
        //Send Password to User
        //$subject='Login Information of TUNINGFILESERVICE24.com';
        //$message = 'Hello '. $user->name .' , Your have successfully register with us, just <a href="'.$link.'" style="color:#f90; font-weight: bold;"> Click Here </a> and input your validation code is : ' . $user->varification_code;

        // if($user){
        //     ome_email($request->email, $subject, $message);
        // }
       
        return redirect()->route('users.index')->with('success', 'Welcome!, you have successfully registered.');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $countries = Country::where('status', 'Active')->pluck('title','code');
        return view('users.create',compact('user','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
         $this->validate($request, [ 
            'anrede' => 'required',
            'first_name' => 'required|min:3|max:50',
            'address' => 'required',
            'email'=> 'required|email',   
            'zip' =>'required',
            'city' =>'required',
            'phone' =>'required',
            'policy' =>'required', 
        ]); 

       
        $input = $request->all();
         

        if(!empty($request->password)){ 
            $this->validate($request, [ 
                'password' => 'required|confirmed|min:6'
            ]);
        } 

        $input['name'] = $request->anrede . '  '. $request->first_name. '  '. $request->last_name; 

        if(!empty($request->password)){ 
            $input['password'] = Hash::make($request->password);
        }
  
        if($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:1000',
            ]); 
            $imageName = 'user-'.time().'.'.$request->image->getClientOriginalExtension(); 
            $request->image->move(public_path('images'), $imageName);
            $input['image'] = $imageName;
        }
  
        $user->update($input);

        return redirect()->route('users.index')->with('success','Users updated successfully');
    }



    //return user profile
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $vendor->update(['status'=>'Inactive']);
        return redirect()->route('users.index')->with('success','Vendor deleted successfully');
    }
}

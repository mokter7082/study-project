<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash; 
use App\User;
use OmeHelper;
use Auth; 
use App\Comment; 
use App\Country; 
use App\Course; 
use App\Ctype; 
use App\GiftVoucher; 
use App\Instructor; 
use App\Order; 
use App\BillingInfo; 
use App\Booking; 
use DB;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');  
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        //User Info 
        $user = User::find(Auth::user()->id);  
       /* if ($user->verified!=1) {
            return redirect()->route('activate-account');
        }*/ 
        return view('profiles.dashboard', compact('user'));
    }


    
    /**
     * Acrive Customer Accounts.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function activeAccountForm()
    {
        return view('users.active_account');
    }



    /**
     * Acrive Customer Accounts.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function activeAccount(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed', 
        ]); 


        //User Info  
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->verified = 1;
        $user->email_verified_at = date('Y-m-d h:i:s');
        $user->save();  

        Auth::logout();
        
        return redirect()->route('login')->with('success','Your accounts verification created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function kontoDetails()
    {
        $user = User::find(Auth::user()->id);
        return view('profiles.edit-profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function kontoUpdate(Request $request, User $user)
    { 
  
        $request->validate([
            'anrede' => 'required', 
            'first_name' => 'required', 
            'address' => 'required', 
            'postcode' => 'required', 
            'city' => 'required', 
            'phone' => 'required', 
            //'phone' => 'required|unique:users,phone,'.$request->id.'|max:155', 
            'email' => 'required|unique:users,email,'.$request->id.'|max:155',  
        ]); 
 
        $user->anrede = $request->anrede;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->anrede . ' '.$request->first_name . ' '. $request->last_name;
        $user->address = $request->address;
        $user->postcode = $request->postcode;
        $user->city = $request->city;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->date_of_birth = !empty($request->date_of_birth)? date('Y-m-d', strtotime($request->date_of_birth)): date('Y-m-d') ;
        
        $user->save();

        /*
        if($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:1000',
            ]); 
            $imageName = 'logo-'.time().'.'.$request->image->getClientOriginalExtension(); 
            $request->image->move(public_path('img'), $imageName);
            $input['image'] = $imageName;
        }
        */ 

        return redirect()->route('customers.dashboard')->with('success','Profile updated successfully');
    }

    //change password
    public function kennwortAndern()
    { 
        return view('profiles.change_password'); 
    }

    //udpate password
    public function updatePass(Request $request)
    {
        $request->validate([
            'email' => 'required', 
            'old_pass' => 'required',   
            'new_pass' => 'required|min:6',   
        ]); 
 
        if (Auth::attempt(['email'=>$request->email, 'password'=>$request->old_pass])) {
            $userId = Auth::id();
            $user = User::findOrFail($userId);
            $user->password = Hash::make($request->new_pass);
            $user->save(); 
            return redirect()->route('customers.dashboard')->with('success','Password updated successfully');
        }

        return redirect()->back()->with('error','Credential does not match'); 
    }

    //My Courses
    public function bestellungen(Request $request)
    { 
        $userId = Auth::id();  
        $bookings = Order::select(
            'orders.*', 
            'users.anrede',
            'users.first_name',
            'users.last_name',
            'users.address',
            'users.postcode',
            'users.email',
            'users.city',
            'users.phone',
            'bookings.day_from',
            'bookings.day_to',
        )
        ->join('users', 'users.id', 'orders.customer_id')
        ->leftJoin('bookings', 'order_id', 'orders.id')
        ->where('orders.customer_id', $userId)
        ->orderByRaw('-orders.id asc')
        ->get(); 

        return view('profiles.my_courses', compact('bookings'));   
    }


    //Mo Orders
    public function myOrders(Request $request)
    { 
        $userId = Auth::id();  
        $courses = Order::select('courses.*')->join('courses', 'courses.id', 'orders.curse_id')->where('customer_id', $userId)->get(); 
        return view('profiles.my_courses', compact('courses')); 
    }

     
}

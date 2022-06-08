<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller; 
use App\User; 
use App\Admin;
use App\Vendor;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

// use guzzle http lib
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Crypt;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest'); 
        $this->middleware('guest:admin');
        $this->middleware('guest:vendor');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    //Show Admin Register Form
    public function showAdminRegisterForm()
    {
        return view('auth.register', ['url' => 'admin']);
    }


    //Show Vendor Register Form
    public function showVendorRegisterForm()
    {
        return view('auth.register', ['url' => 'vendor']);
    }


    //Show Vendor Register Form
    public function showUserRegisterForm()
    {
        $countries = Country::where('status', 'Active')->pluck('title','code');
        return view('users.register', compact('countries'));
    }



    //Store Admin Post Request
    protected function createAdmin(Request $request)
    {
        $this->validator($request->all())->validate();
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/admin');
    }

    //Store Vendor Post Request
    protected function createVendor(Request $request)
    {
        $this->validator($request->all())->validate();
        $vendopr = Vendopr::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/vendopr');
    }


    //Store Vendor Post Request
    protected function createUsers(Request $request)
    {  
        $this->validate($request, [  
            'salute' => 'required',
            'fname' => 'required|min:3|max:50',
            'email'=> 'required|email|unique:users,email',  
            'password' => 'required|confirmed|min:6',  
            'address' =>'required',
            'zip' =>'required',
            'city' =>'required',
            'phone1' =>'required',
            'policy' =>'required', 
        ]); 

        $code = Str::random(8);
        $input = $request->all();
        $input['varification_code'] = $code;
        $input['password'] = Hash::make($request->password);
        $input['full_name'] = $request->salute . '  '. $request->fname. '  '. $request->lname; 


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
        $link = url('/verify-account').'/'. base64_encode($user->email.'#*#'.$user->varification_code);
  
        //Send Password to User
        $subject='Login Information of dancezone';
        $message = 'Hello '. $user->name .' , Your have successfully register with us, just <a href="'.$link.'" style="color:#f90; font-weight: bold;"> Click Here </a> and input your validation code is : ' . $user->varification_code;

        if($user){
            ome_email($request->email, $subject, $message);
        }
        
       
        return redirect()->route('login')->with('success_sweet', 'We have sent you an e-mail with a verification code. Please follow the link in the e-mail and confirm your registration with the code.');
    }


    //check if EVC CUSTOMER
    public function checkEVCinformation(Request $request){
        $api_url = 'https://evc.de/services/api_resellercredits.asp?apiid=j34sbc93hb90&username=centurorb&password=wo@36Z45&verb=checkevccustomer&customer=13698';
        $client = new Client();

        $res = $client->request('GET', $api_url);

        $response = $res->getBody()->getContents();

        //dd($response);

    } 

    //verify account form
    public function verifyForm($encdata=null)
    {
        if ($encdata) { 
            $code = base64_decode( $encdata );  
            $codeArray = explode('#*#',  $code);
            $data['email']= $codeArray[0];
            $data['code']= $codeArray[1]; 
            return view('users.verify', $data);
        } 

        return redirect()->route('404')->with('error', 'Sorry!, this link is invalid'); 
    }

    //verify
    public function activeAccount(Request $request)
    {
        $isverify = User::where('email', $request->email)->where('varification_code', $request->varification_code)->first();

        if ( $isverify) {
            $isverify->email_verified_at = date('Y-m-d h:i:s');
            $isverify->verified = 1;
            $isverify->save();

            return redirect()->route('login')->with('success', 'Success!, you have successfully verified. you can login now');

        }else{
             return redirect()->back()->with('error', 'Sorry!, your code is invalid, please try with valid code'); 
        } 
    }
}

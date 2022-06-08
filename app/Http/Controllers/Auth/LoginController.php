<?php

namespace App\Http\Controllers\Auth; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:vendor')->except('logout');
    }


    //Show Login Form
    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }


    //Admin Login Post
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/bdrentz-admin');
        }
        return back()->withInput($request->only('email', 'remember'));
    }


    //show Vendor Login Form
    public function showVendorLoginForm()
    {
        return view('auth.login', ['url' => 'vendor']);
    }

    //Post Vendor Login
    public function vendorLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('vendor')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/vendor');
        }
        return back()->withInput($request->only('email', 'remember'));
    }


    //show Vendor Login Form
    public function showUsersLoginForm()
    {
        return view('users.login');
    }


    //Admin Login Post
    public function userLogin(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(Auth::guard('web')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->get('remember'))) {

            if(isset($request->redirect)){
                return redirect()->intended($request->redirect);
            }
            return redirect()->intended('/dashboard');
        }
        
        return redirect()->back()->with('error', 'Der Berechtigungsnachweis stimmt nicht überein. Bitte versuchen Sie es mit den richtigen Informationen');

        //return back()->withErrors(['credintial', ''])->withInput($request->only('email', 'remember'))
    }


}

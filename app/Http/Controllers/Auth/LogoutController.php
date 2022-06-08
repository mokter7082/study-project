<?php 
namespace App\Http\Controllers\Auth; 

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Auth;

class LogoutController extends Controller
{
     
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        Auth::guard('admin')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    } 
}

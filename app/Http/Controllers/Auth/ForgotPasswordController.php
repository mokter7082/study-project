<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers; 
use DB;
use App\User; 
use Carbon\Carbon;

// use guzzle http lib
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Crypt;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    //Store Vendor Post Request
    public function sedResetLink(Request $request)
    {
        $this->validate($request, [  
            'email'=> 'required|email',   
        ]); 

        $user = DB::table('users')->where('email', '=', $request->email)->first();

        //Check if the user exists
        if (!$user->email) {
            return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
        }
 
        //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => str_random(60),
            'created_at' => Carbon::now()
        ]);

        //Get the token just created above
        $tokenData = DB::table('password_resets')->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return redirect()->back()->with('success', trans('A reset link has been sent to your email address.'));
        } else {
            return redirect()->back()->with(['error' => trans('A Network Error occurred. Please try again.')]);
        } 
    }


    /* SEND EMAIL */
    public function sendResetEmail($email, $token)
    {
    //Retrieve the user from the database
    $user = DB::table('users')->where('email', $email)->select('name', 'email')->first();
    //Generate, the password reset link. The token generated is embedded in the link
    $link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($user->email); 
        try { 
            //Send Password reset link
            $subject='Reset Password Information of TUNINGFILESERVICE24.com';
            $message = 'Hello '. $user->name .' , Your have request to reset your password, just <a href="'.$link.'" style="color:#f90; font-weight: bold;"> Click Here </a> and update your password';

            //mail
            if(ome_email($user->email, $subject, $message)){
               return true;
           } 
            return false; 
        } catch (\Exception $e) {
            return false;
        }
    }

}

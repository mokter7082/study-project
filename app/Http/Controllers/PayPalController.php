<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Crypt;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\TuningPackage;
use App\Order;
use App\CreditTransaction;
use Auth;
use DB;

class PayPalController extends Controller
{
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request)
    { 
    	//request information
    	$package_id = Crypt::decryptString($request->package_id);
    	$total = round(Crypt::decryptString($request->total),2);
    	$invoice = intval(Crypt::decryptString($request->invoice));
  
    	//Check and redirect
		if(!$package_id || !$total || ($package_id != session()->get('package_id'))){
			return redirect('404')->with('Error', 'Something wrong please try with valid data');
		}
 		
 		//get package info
 		$package_info = TuningPackage::find($package_id);


 		//Prepare date fir payment
        $data = [];

        $data['items'] = [
            [
                'name' => $package_info->number_of_credits.' ' .$package_info->title,
                'price' => $total, //$package_info->price,
                'desc'  => 'Buy Credit '. $package_info->number_of_credits.' ' .$package_info->title,
                'qty' => 1
            ]
        ]; 

        $data['invoice_id'] = $invoice; 
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('customers.paypal-success');
        $data['cancel_url'] = route('customers.paypal-cancel');
        $data['total'] = $total; //$package_info->price;
  			

        $provider = new ExpressCheckout;
          
        $response = $provider->setExpressCheckout($data);
  
        $response = $provider->setExpressCheckout($data, true);

        return redirect($response['paypal_link']);
    }


    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    { 
    	$provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        $package_id = session()->get('package_id'); 
        $package_info = TuningPackage::find($package_id);
 
        if ($package_info && in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
     
            $order = new Order;
            $order->order_code = keg_generate('order', 'Ord-');
            $order->invoice_number = $response['INVNUM'];
            $order->customer_id = Auth::user()->id;
            $order->package_id = $package_id;
            $order->payment_method = 'paypal';
            $order->credits = $package_info->number_of_credits;
            $order->price = $response['AMT'];
            $order->currency = $response['COUNTRYCODE'];
            $order->order_date = $response['TIMESTAMP'];
            $order->description = $response['L_NAME0'];
            $order->status = $response['ADDRESSSTATUS'];  
            
            DB::beginTransaction();
           
            try {

                $order->save();

                $transaction = new CreditTransaction;
                $transaction->transaction_code = keg_generate('CreditTransaction', 'CT-');
                $transaction->order_id =  $order->id;
                $transaction->customer_id = $order->customer_id;
                $transaction->credits = $order->credits;
                $transaction->transaction_date = date('Y-m-d H:i:s');
                $transaction->description = $order->description;
                $transaction->build = $response['BUILD'];
                $transaction->email = $response['EMAIL'];
                $transaction->payerid = $response['PAYERID'];
                $transaction->payerstatus = $response['PAYERSTATUS'];
                $transaction->firstname = $response['FIRSTNAME'];
                $transaction->lastname = $response['LASTNAME'];
                $transaction->cuntrycode = $response['COUNTRYCODE'];
                $transaction->currencycode = $response['CURRENCYCODE'];
                $transaction->amt = $response['AMT'];
                $transaction->itemamt = $response['ITEMAMT'];
                $transaction->taxamt = $response['TAXAMT'];
                $transaction->status = $response['ADDRESSSTATUS'];
                $transaction->save(); 

                DB::commit(); 

                //return response                
                return redirect()->route('customers.order-history')->with('success', 'Thanks you have  purchased  credits successfully');

            }catch (\Exception $e){
                DB::rollback();
            }
        }
  
        return redirect('404')->with('Error', 'Something wrong please try with valid data');
    }



    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        return redirect('404')->with('Error', 'Your payment is canceled.'); 
        //dd('Your payment is canceled. You can create cancel page here.');
    }



}

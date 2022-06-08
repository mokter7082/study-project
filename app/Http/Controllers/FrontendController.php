<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use App\Events\InvoiceMailEvent;
use App\Page;
use App\Post;
use App\Meta; 
use App\Settings; 
use App\Category; 
use App\Comment; 
use App\Country; 
use App\Course; 
use App\Ctype; 
use App\GiftVoucher; 
use App\Instructor; 
use App\Language; 
use App\Location; 
use App\Menu; 
use App\User; 
use App\Widget; 
use App\Order; 
use App\BillingInfo; 
use App\News;
use App\Gallery;
use PDF;
use DB;
use Mail;
use Auth;

class FrontendController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tody = date('Y-m-d');
        $firstDay = date("Y")."-01-01";
        $lastDay =  date("Y")."-12-31";

        $data['course_types'] = Ctype::select('ctypes.*')
            ->join('course_ctype', 'course_ctype.ctype_id', 'ctypes.id')
            ->join('courses', 'course_ctype.course_id', 'courses.id')
            ->where('courses.available_date', '<=', $tody )
            ->where('courses.close_date', '>=', $tody)
            ->where('ctypes.status', 'Active')
            ->groupBy('ctypes.slug')
            ->get();

        $data['courses'] = Course::with('ctypes')->where('available_date', '<=', $tody )
            ->where('close_date', '>=', $tody)
            ->where('courses.status', 'Active')
            ->get();  

        $schedule = DB::table('schedules')
            ->select('schedules.start_at as date') 
            ->where('schedules.start_at', '>=', $firstDay)
            ->where('schedules.start_at', '<=', $lastDay)
            ->groupBy('schedules.start_at')
            ->get()->toArray(); 

        $data['today_couse'] = DB::table('courses')
            ->join('schedules', 'schedules.course_id', 'courses.id')
            ->where('schedules.start_at', $tody) 
            ->where('courses.status', 'Active')
            ->groupBy('courses.id')
            ->get()->toArray();  

        $data['note'] = json_encode($schedule); 

        return view('pages.index',$data);
    } 


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ajaxCourse(Request $request)
    { 

        if (!empty($request->course_date)) { 

            $course_date = $request->course_date;

            $data['today_couse'] = DB::table('courses')
                ->join('schedules', 'schedules.course_id', 'courses.id')
                ->where('schedules.start_at', $course_date) 
                ->groupBy('courses.id')
                ->get()->toArray(); 

             $data['course_date'] = $request->course_date;

            $view =  view('pages.ajax_course',$data)->render(); 

            return response()->json([
                'data' => $view,
                'status' => 'success',
            ]);
        }

        return response()->json([
            'data' => null,
            'status' => 'error',
        ]);
    }


    /**
     * All Course Types
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tanzkurse()
    { 
        $tody = date('Y-m-d'); 
        $cdata = Course::select('courses.*', 'ctypes.title as course_type')
            ->join('course_ctype', 'course_ctype.course_id', 'courses.id')
            ->join('ctypes', 'ctypes.id', 'course_ctype.ctype_id')
            ->where('courses.available_date', '<=', $tody)
            ->where('courses.close_date', '>=', $tody)
            ->where('courses.status', 'Active')
            ->groupBy('courses.slug')
            ->groupBy('ctypes.slug')
            ->get(); 

        $courses = [];
        foreach ($cdata as $couse) {
            $courses[$couse->course_type][] = $couse;
        } 

        return view('pages.tanzkurse',compact('courses'));
    }
    

    //display single courses
    public function singleCourse ($slug)
    {
        $data = []; 

        if (empty($slug)) { return abort(404); } 

        $data['course'] = Course::where('slug', $slug)->first();  

        return view('pages.single_course',$data);
    }

    /*
    * Single Course Type
    ---------------------------------------*/
    public function singleTanzkurse ($slug)
    {
        $data = []; 
        $tody = date('Y-m-d');

        if (empty($slug)) { return abort(404); }

        $ctype = Ctype::where('slug', $slug)->first();  

        $data['couses'] = Course::select('courses.*', 'ctypes.title as course_type')
            ->join('schedules', 'schedules.course_id', 'courses.id')
            ->join('course_ctype', 'course_ctype.course_id', 'courses.id')
            ->join('ctypes', 'course_ctype.ctype_id', 'ctypes.id')
            ->where('schedules.start_at', '>=', $tody) 
            ->where('ctypes.id', $ctype->id) 
            ->groupBy('courses.id')
            ->get();  

        $data['ctype'] = $ctype;
        $data['allCtype'] = Ctype::where('status', 'Active')->orderByRaw('-sort_order desc')->get(); 

        return view('pages.signle_ctype',$data);
    }

    /*
    * kasse Process
    ---------------------------------------*/
    public function kasseProcess(Request $request)
    { 
        if(isset($request->course_id) && !empty($request->course_id)) {
            $data = array(
                'course_id' => $request->course_id, 
                'price' => $request->price, 
                'ticket_type' => $request->ticket_type, 
            ); 
            session()->forget('coursedata');
            session()->put('coursedata', $data); 
            return redirect()->route('kasse'); 
        }else{ 
            return abort(404);
        }  
    }

    /*
    * kasse
    ---------------------------------------*/
    public function kasse(Request $request)
    { 
        $sdata = session('coursedata');
        if (!empty($sdata)) {
            $data['couseInfo'] = Course::where('id', $sdata['course_id'])->first();
            $data['ticket_type'] = $sdata['ticket_type'];
            $data['price'] = $sdata['price'];

            if (auth()->check()) {
                $userId = Auth::id(); 
                $data['user'] = User::where('id', $userId)->first();
            }
            return view('pages.kasse', $data);
        } else{ 
            return abort(404)->with('error', 'Please select any courses');
        } 
        
    }
  

    /*
    * Place order
    ---------------------------------------*/
    public function placeOrder(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required', 
            'ticket_type' => 'required',
            'price' => 'required', 
        ]);
        
        //get package info
        $couseInfo   = Course::where('id',$request->course_id)->first(); 
        $ticket_type = $request->ticket_type;
        $price       = $request->price;
        $total_pay   = floatval($price - $request->discount);

        //order info
        $ord = Order::where('invoice_number', '!=', '')->orderBy('invoice_number', 'DESC')->first(); 
        $invoice = intval(($ord->invoice_number??0) + 1);


        /* DB::beginTransaction(); 
        try { */

            //new Registration
            if (!auth()->check()) {
                $email = !empty($request->account_username)?$request->account_username:$request->billing_email;

                $checkUser = User::where('email', $email)->first();

                if ($checkUser) {
                    $user = $checkUser;
                }else{
                    $pas = !empty($request->account_password)?$request->account_password:123456789;
                    $password = Hash::make($pas);

                    $user = new User;
                    $user->email = $email;
                    $user->password = $password;
                    $user->pass_string = $pas;
                    $user->anrede = $request->billing_anrede;
                    $user->first_name = $request->billing_first_name;
                    $user->last_name = $request->billing_last_name;
                    $user->name = trim($request->billing_anrede.' '.$request->billing_first_name. ' '. $request->billing_last_name);
                    $user->address = $request->billing_address_1;
                    $user->postcode = $request->billing_postcode;
                    $user->city = $request->billing_city;
                    $user->phone = $request->billing_phone;
                    $user->date_of_birth = date('Y-m-d', strtotime($request->billing_date_of_birth));
                    $user->save();
                }                 
            }else{
                $userId = Auth::id(); 
                $user = User::where('id', $userId)->first();
            }

            $order = new Order; 
            $order->order_code      = keg_generate('order', 'Ord-');
            $order->invoice_number  = $invoice;
            $order->customer_id     = $user->id;
            $order->curse_id        = $couseInfo->id;
            $order->ticket_type     = $ticket_type;
            $order->payment_method  = $request->payment_method; 
            $order->discount        = $request->discount;
            $order->price           = $request->price;
            $order->total_pay       = $total_pay;
            $order->currency        = 'euro';
            $order->order_date      = date('Y-m-d H:i:s');
            $order->description     = '';
            $order->coupon_code     = $request->coupon_code; 
            $order->status          = 'Pending'; 
            $order->save(); 

  
            $billing = new BillingInfo;
            $billing->anrede           = $request->billing_anrede;
            $billing->first_name       = $request->billing_first_name;
            $billing->last_name        = $request->billing_last_name;
            $billing->address          = $request->billing_address_1;
            $billing->postcode         = $request->billing_postcode; 
            $billing->city             = $request->billing_city;
            $billing->email            = $request->billing_email;
            $billing->phone            = $request->billing_phone;
            $billing->date_of_birth    = $request->billing_date_of_birth; 
            $billing->billing_type     = 'Einzelperson';
            $billing->status           = 'Active';
            $billing->order_id         = $order->id;
            $billing->created_at       =  date('Y-m-d H:i:s');
            $billing->save();

            if ($ticket_type =='paar') { 
                $paar_billing                 = new BillingInfo;
                $paar_billing->anrede         = $request->p_anrede;
                $paar_billing->first_name     = $request->p_first_name;
                $paar_billing->last_name      = $request->p_last_name;
                $paar_billing->address        = $request->p_address;
                $paar_billing->postcode       = $request->p_postcode; 
                $paar_billing->city           = $request->p_city;
                $paar_billing->email          = $request->p_email;
                $paar_billing->phone          = $request->p_phone;
                $paar_billing->date_of_birth  = $request->p_birth_date; 
                $paar_billing->billing_type   = 'Paar';
                $paar_billing->status         = 'Active';
                $paar_billing->order_id       = $order->id;
                $paar_billing->created_at     =  date('Y-m-d H:i:s');
                $paar_billing->save();
            }


            // DB::commit();  

            //sending email with invoice  
            event( new InvoiceMailEvent($order, $billing->email)); 

            //session removed
            session()->forget('coursedata');

            $urlArr = [
                'customer' => $order->customer_id,
                'email_' => $user->email,
                'rand_' => $user->pass_string,
                'order' => $order->id,
                'name' => $billing->anrede . ' '. $billing->first_name.' '.$billing->last_name
            ];

            $url = json_encode($urlArr);

            $url = urlencode($url);
 
            //return response                
            return redirect()->route('success-order', $url)->with('success', 'Thanks you have  purchased  credits successfully');

        /*}catch (\Exception $e){
            DB::rollback();
        }*/

        return redirect()->back()->with('Error', 'Something wrong please try with valid data');  
    }
 
    /*
    * Pages
    ---------------------------------------*/ 
    public function successOrder($urlarg=null)
    { 
        $urldata = json_decode($urlarg); 
        if (empty($urldata) || empty($urldata->customer) || empty($urldata->order)) {
            return abort(404); 
        } 
        //dd($data->order,$data->email_, $data->rand_); 
         
        $order = Order::findOrFail($urldata->order);

        $data = array(
            'order' => $order,
            'name' => str_replace('+', ' ', $urldata->name),
            'email' => $urldata->email_,
            'pass' => $urldata->rand_,
        );
 

        return view('pages.success_order', $data);
    }
    
    //test Invoice Mail
    public function invoiceMail(Request $request)
    { 
        #event(new InvoiceMailEvent($order));
        //$order =  Order::findOrFail(16);  
        //event( new InvoiceMailEvent($order, 'a.bakar87@gmail.com') ); 

       $data['order_info'] = Order::join('billing_infos', 'billing_infos.order_id', 'orders.id')
       ->where('orders.id', 16)->first(); 
       return view('mails.invoice', $data);  
    }

    public function pdftest(Request $request)
    { 
        $data['order_info'] = Order::join('billing_infos', 'billing_infos.order_id', 'orders.id')->where('orders.id', 16)->where('billing_type', 'Einzelperson')->first();  
        return view('pages.invoice', $data); 
    }

    //Test Mail
    public function sendmail(Request $request){ 

        $data["email"]= 'a.bakar87@gmail.com';
        $data["client_name"]= 'shamim';
        $data["subject"]= 'test'; 
        $data['order_info'] = Order::join('billing_infos', 'billing_infos.order_id', 'orders.id')->where('orders.id', 16)->where('billing_type', 'Einzelperson')->first();

        $pdf = PDF::loadView('mails.invoice', $data); 
        
        try{
            Mail::send('mails.invoice', $data, function($message)use($data,$pdf) {
            $message->to($data["email"], $data["client_name"])
            ->subject($data["subject"])
            ->attachData($pdf->output(), "invoice.pdf");
            });
        }catch(JWTException $exception){
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }

        if (Mail::failures()) {
            return Redirect()->back()->with(['errors', 'Error sending mail']); 
        } 
        
        return redirect()->back()->with('success', 'Message sent Succesfully');   
    }

    //Dance voucher Mail 
    public function danceVoucherMail(Request $request){ 

        $request->validate([
            'vorname' => 'required', 
            'email' => 'required|email', 
            'telefon' => 'required',
            'strasse' => 'required',
            'plz' => 'required',
            'ort' => 'required',
        ]); 

        $data = $request->except('_token');  
        $data["subject"]= 'Verschenke Tanzspass bei Dancezone';  
        $data["to_mail"]= env("ADMIN_EMAIL", "a.bakar87@gmail.com");
        
        try {
            Mail::send('mails.voucher', $data, function($message)use($data){
                $message->to($data["to_mail"])->subject($data["subject"]) ;
            });
        } catch (Exception $e) {
            return Redirect()->back()->with(['errors', $error->getMessage()]); 
        }
          

        if (Mail::failures()) {
            return Redirect()->back()->with(['errors', 'Error sending mail']); 
        } 
        
        return redirect()->back()->with('success', 'Message sent Succesfully');   
    }


    /*
    * Paews Popup
    ---------------------------------------*/
    public function newspop(Request $request)
    {
        $data['news'] = News::find($request->news_id);

        $view = view('backend.news.nespop', $data)->render(); 


        return response()->json([
            'data'=>$view,
            'title'=> ucfirst($data['news']->title),
            'status'=>'success'
        ]);

    }


    /*
    * Ajax Gallery Popup
    ---------------------------------------*/
    public function gallerypop($id)
    {
        $data['gallery'] = Gallery::find($id); 
        return view('backend.gallery.popup', $data); 
    }



    /*
    * Pages
    ---------------------------------------*/
    public function pages($slug)
    {
         
        $data = Page::where('slug', $slug)->first(); 

        if($data->template == 'galerie'){
            $compact['galleries'] =  Gallery::where('status', 'Active')->get();
        }

        $compact['data'] = $data;

        if ($slug && $data) {
           return view('pages.'.$data->template, $compact); 
        }

       return abort(404);

    }
 
    
}

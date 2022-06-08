<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Booking;
use App\Order;
use PDF;

class BookingController extends Controller
{
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:booking-list|booking-create|booking-edit|booking-delete', ['only' => ['index','store']]);
        $this->middleware('permission:booking-create', ['only' => ['create','store']]);
        $this->middleware('permission:booking-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:booking-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::select(
            'orders.*', 
            'billing_infos.anrede',
            'billing_infos.first_name',
            'billing_infos.last_name',
            'billing_infos.address',
            'billing_infos.postcode',
            'billing_infos.email',
            'billing_infos.city',
            'billing_infos.phone',
        )->join('billing_infos', 'billing_infos.order_id', 'orders.id')
        ->where('orders.status', 'Pending')
        ->orderByRaw('-orders.id asc')
        ->get(); 

        return view('backend.bookings.list', compact('orders')); 
    }

    public function list()
    {
        $bookings = Booking::select(
            'bookings.*', 
            'orders.id as order_id',
            'users.anrede',
            'users.first_name',
            'users.last_name',
            'users.address',
            'users.postcode',
            'users.email',
            'users.city',
            'users.phone',
        )->join('users', 'users.id', 'bookings.user_id') 
        ->join('orders', 'orders.invoice_number', 'bookings.invoice_number')
        ->orderByRaw('-bookings.id asc')
        ->get(); 

        return view('backend.bookings.booklist', compact('bookings')); 
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $order = Order::select(
            'orders.*', 
            'billing_infos.anrede',
            'billing_infos.first_name',
            'billing_infos.last_name',
            'billing_infos.address',
            'billing_infos.postcode',
            'billing_infos.email',
            'billing_infos.city',
            'billing_infos.phone',
        )
        ->join('billing_infos', 'billing_infos.order_id', 'orders.id')
        //->where('orders.status', 'Pending')
        ->where('orders.id', $id)
        ->orderByRaw('-orders.id asc')
        ->first();

        return view('backend.bookings.create', compact('order'));  
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {  

        if (empty($request->order_id) || empty($request->status)) {return abort(404);}

        $order = Order::findOrFail($request->order_id);
        $order->status = $request->status;
        $order->save();

        if ($order->status =='Canceled') {
            return redirect()->back()->with('success','Request cancled successfully');
        }

        if ($order->status =='Confirmed') {
            $booking = new Booking;
            $booking->course_id = $order->curse_id;
            $booking->invoice_number = $order->invoice_number;
            $booking->order_id = $order->id;
            $booking->user_id = $order->customer_id;
            $booking->voucher_code = $order->coupon_code;
            $booking->day_from = date('Y-m-d', strtotime($request->day_from));
            $booking->day_to =  date('Y-m-d', strtotime($request->day_to));
            $booking->ticket_type = $order->ticket_type;
            $booking->price = $order->price;
            $booking->description = $order->discount;
            $booking->status = 'Complete';
            $booking->save();

            return redirect()->back()->with('success','Booking is successfully completed');
        }

        return redirect()->back()->with('error','Something wrong please try with appropriet data');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }


    //invoice downlaod
    public function pdfDownload($order_id){
        $order_info = Order::join('billing_infos', 'billing_infos.order_id', 'orders.id')
        ->where('orders.id', $order_id)->first(); 

        $pdf = PDF::loadView('pages.invoice', compact('order_info'));
        return $pdf->download('invoice_'. $order_info->invoice_number .'.pdf'); 
    }

}

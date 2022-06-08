<?php

namespace App\Listeners;

use App\Events\InvoiceMailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue; 

use App\Mail\InvoiceMail;
use App\Order; 
use PDF;
use Mail;

class InvoiceListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  InvoiceMailEvent  $event
     * @return void
     */
    public function handle(InvoiceMailEvent $event)
    {   
        $date['order_info'] = Order::join('billing_infos', 'billing_infos.order_id', 'orders.id')
        ->where('orders.id', $event->order->id)->first(); 

        $pdf = PDF::loadView('pages.invoice', $date);
        $pdfFile = $pdf->output();
 
        Mail::to($event->email)->send(new InvoiceMail($date, $pdfFile));
    }
}

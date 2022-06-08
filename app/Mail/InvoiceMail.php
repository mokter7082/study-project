<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;
    private $pdfFile;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $pdfFile)
    {
        $this->data = $data; 
        $this->pdfFile = $pdfFile;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        return $this->subject('Online Registration')
            // ->from('infobasedevelop@gmail.com', 'Infobase Development')
            ->bcc('a.bakar87@gmail.com')
            ->view('mails.invoice', $this->data)  
            ->attachData($this->pdfFile, 'invoice.pdf'); 
    }
}

<?php
  
namespace App\Mail;
   
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
  
class SendMail extends Mailable
{
    use Queueable, SerializesModels;
  
    public $details;
   
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }
   
    /**
     * Build the message.
     *
     * @return $this
     */
     public function build()
    {
        
        if (isset($this->details["file"]) ){

            $file=$this->details["file"];
            if($file){
                return $this->subject('SAKA-SAV')
                ->attachData($file, "invoice.pdf")
                        ->view('emails.sendmail');
            }
        }else{
            return $this->subject('Nouvelle Tache')
            ->view('emails.operation');
        }
       
       
    }
}
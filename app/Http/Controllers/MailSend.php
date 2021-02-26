<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Mail\SendMail;
use PDF;
class MailSend extends Controller
{
    public function mailsend()
    {
        $commandes= \App\Models\Commande::all();
        $pdf = PDF::loadView('Pdf.pdf',["commandes"=>$commandes]);    
        
        $details = [
            'title' => 'Renumération plus les jours fériés',
            "body" => "Bonjour chers Développeurs",
            "file"=>$pdf->output()
            
        ];
        // \Mail::to('medoune.sene@mediapex.pro')->send(new SendMail($details));
        // \Mail::to('moustapha.gueye@mediapex.pro')->send(new SendMail($details));
        // \Mail::to('aziz.fall@mediapex.pro')->send(new SendMail($details));
        // \Mail::to('moussa.thiam@mediapex.pro')->send(new SendMail($details));
         \Mail::to('fatoubibi96@gmail.com')->send(new SendMail($details));
        \Mail::to('hildedokou@gmail.com')->send(new SendMail($details));
        \Mail::to('diattamohamet30@gmail.com')->send(new SendMail($details));
        return view('emails.thanks');
    }
}
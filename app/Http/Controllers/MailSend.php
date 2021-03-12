<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Mail\SendMail;
use PDF;
use App\Models\Voiture;
use App\Models\Diagnostic;
use App\Models\Intervention;
use App\Models\Devi;
use App\Models\Produit;
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
    }   
        public function send_devis($id)
    {
             $devis_id=Intervention::find($id)->devis_id;
            $devi = Devi::find($devis_id);
            $pdevis=$devi->produits()->get();
            $devi_client=Intervention::find($id)->voiture->client()->first();

   //dd(Intervention::find($id)->voiture->client()->get());
  // $commandes= \App\Models\Commande::all();
   
        $pdf = PDF::loadView('Pdf.pdf',compact('pdevis','devi','devi_client'));   
        $details = [
            'title' => 'DEVIS GARAGE SAKA',
            "body" => "Bonjour chers Client",
            "file"=>$pdf->output()
            
        ];
        // \Mail::to('medoune.sene@mediapex.pro')->send(new SendMail($details));
        // \Mail::to('moustapha.gueye@mediapex.pro')->send(new SendMail($details));
        // \Mail::to('aziz.fall@mediapex.pro')->send(new SendMail($details));
        // \Mail::to('moussa.thiam@mediapex.pro')->send(new SendMail($details));
        //Mail::to('fatoubibi96@gmail.com')->send(new SendMail($details));
        \Mail::to('hildedokou@gmail.com')->send(new SendMail($details));
        \Mail::to('diattamohamet30@gmail.com')->send(new SendMail($details));
        return view('emails.thanks');
    }
}
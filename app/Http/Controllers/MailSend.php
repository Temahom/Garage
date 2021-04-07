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
                        $intervention = Intervention::find($id);
            //dd(Intervention::find($id)->voiture->client()->get());
            // $commandes= \App\Models\Commande::all();
            
                    $pdf = PDF::loadView('Pdf.pdf',compact('pdevis','devi','devi_client'));   
                    $details = [
                        'title' => 'DEVIS GARAGE SAKA',
                        "body" => "Bonjour chers Client",
                        "file"=>$pdf->output()
                        
                    ];
                    
                    \Mail::to($devi_client->email)->send(new SendMail($details));
                    return redirect('/voitures/'.$intervention->voiture_id.'/interventions/'.$intervention->id)->with('devis-send','Le devis a été envoyer à '. $devi_client->email .'avec succés');
                    //return view('emails.thanks');
                }

                public function notification_operation($data,$url)
                {  
                    $mon_url='Vous avez une nouvelle notification. Veuillez cliquer sur <a href="'.$url .'" target="_blank"> Ce Lien</a>';
                    //dd($data->email);
                    $details = [
                        'title' => 'Notification SAKA-GARAGE',
                        'body' => $mon_url
                        
                        
                    ];
                    \Mail::to($data->email)->send(new SendMail($details));
                   
                }   
}

<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Devi;
use \App\Mail\SendMail;
use App\Models\Facture;
use App\Models\Produit;
use App\Models\Voiture;
use App\Models\Diagnostic;
use App\Models\Intervention;
use Illuminate\Http\Request;

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
                
                /**
                 * Pour da la factur au client
                 */
                public function facture_pdf_send($id)
                {
                    $facture=Facture::find($id);
                    $intervention=$facture->intervention->first();
                    $prix_total=0;
                    $les_devis=0;
                    $diagnostic=Diagnostic::find($intervention->diagnostic_id);
                    $prix_total=$diagnostic->coût;
                    $voiture=Voiture::find($intervention->voiture_id);
                    $client=Client::find($voiture->client_id);
                    //dd($client);
                    $prix_total=$diagnostic->coût;
                    $prix_facture=0;
                    $prixHT=0;
                    if (! $intervention->devis_id) {
                        //return View('Pdf.facture',compact('prix_total','facture','client'));
                        $pdf = PDF::loadView('Pdf.facture',compact('prix_total','facture','client'));       
                        
                    } else {
                        $devi = Devi::find($intervention->devis_id);
                        $les_devis=$devi->produits()->get();
                            $pdf=PDF::loadView('Pdf.facture',compact('prix_total','facture','client','les_devis','devi'));
                            $prixHT+=$devi->cout;
                    }
                    
                       if ($les_devis) {
                        foreach ($les_devis as $le_devi) {
                            $prixHT += $le_devi->pivot->quantite * $le_devi->prix1;
                        }
                        $prix_facture+=$prixHT;
                       }
                       $prix_facture+=$diagnostic->coût;
                    $details = [
                        'title' => 'facture GARAGE SAKA',
                        "body" => $client,
                        'numero'=>$facture->numero,
                        'prix_facture'=>$prix_facture,
                        "file"=>$pdf->output()
                        
                    ];
                    
                    \Mail::to($client->email)->send(new SendMail($details));
                    return redirect('/voitures/'.$intervention->voiture_id.'/interventions/'.$intervention->id)->with('facture-send','La facture a été envoyer à '. $client->email .' avec succés');
                
                    
                    
                }
}

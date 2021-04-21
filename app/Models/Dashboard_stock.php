<?php

namespace App\Models;

use App\Models\Devi;
use App\Models\Produit;
use App\Models\Devi_produit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

  
    //AFFICHAGE DES PRODUITS QUI SONT DANS LE DEVIS
    public static function listeProduitDansDevi($produit_id , $devis_id)
    {
        $listeProduitDevi = 0;
        foreach ($devis as  $devi) {
            if($devi->produit_id != 0)
            {
                $listeProduitDevi = $listeProduitDevi + 1;
                
            }
        }
        return $listeProduitDevi;
    }
   

    //TABLEAU RECAPITULATIF PAR JOUR
 /*   public static function tabRecupDays()
    {
        $tabRecupDays[] = [];
        
        for($i = 0; $i < 5; $i++)
        {
            $date = date('Y-m-d', (strtotime(date('Y-m-d'). ' - '.$i.' days')));
            $tabRecupDays[$i]['date'] = $date;
            $interventions = Intervention::where('created_at','like', $date.'%')->get();
            $tabRecupDays[$i]['nbIntervention'] = $interventions->count();
            $tabRecupDays[$i]['facturePaye'] = 0;
            $tabRecupDays[$i]['chiffreAffaire'] = 0;
            foreach ($interventions as  $intervention) {
                if($intervention->facture_id)
                {
                    $facture = Facture::find($intervention->facture_id);
                    if ($facture->etat == 1) 
                    {
                        $tabRecupDays[$i]['facturePaye'] += self::sommeFacture($intervention->id) ;
                    }
                    if ($facture->etat == 2)
                    {
                        $tabRecupDays[$i]['chiffreAffaire'] += self::sommeFacture($intervention->id) ;
                    }
                    
                }
            }
        }
        return $tabRecupDays;
    }
*/
   
}

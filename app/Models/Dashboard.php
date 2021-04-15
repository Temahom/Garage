<?php

namespace App\Models;

use App\Models\Intervention;
use App\Models\Voiture;
use App\Models\Devi;
use App\Models\Produit;
use App\Models\Devi_produit;
use App\Models\Facture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    public static function est()
    {
        $resul = self::sommeFacture(3);
        dd($resul);
    }

    public static function sommeFacture($intervention_id)
    {
        $sommeFacture = 0;
        $intervention = Intervention::find($intervention_id);
        $devi = Devi::find($intervention->devis_id);
        $devi_produits = $devi->devi_produits()->get();
        foreach($devi_produits as $devi_produit)
        {
            $produit = Produit::find($devi_produit->produit_id);
            $sommeFacture += $devi_produit->quantite * $produit->prix1;
        }
        $sommeFacture += $devi->cout;
        return $sommeFacture;
    }

    
    public static function tabRecupLastSevenDays()
    {
        $tabRecupLastSevenDays[] = [];
        
        for($i = 0; $i < 7; $i++)
        {
            $date = date('Y-m-d', (strtotime(date('Y-m-d'). ' - '.$i.' days')));
            $tabRecupLastSevenDays[$i]['date'] = $date;
            $interventionByMoths = Intervention::where('created_at','like', $date.'%')->get();
            $tabRecupLastSevenDays[$i]['nbIntervention'] = $interventionByMoths->count();
            $tabRecupLastSevenDays[$i]['facturePaye'] = 0;
            $tabRecupLastSevenDays[$i]['chiffreAffaire'] = 0;
            foreach ($interventionByMoths as  $interventionByMoth) {
                if($interventionByMoth->facture_id)
                {
                    $facture = Facture::find($interventionByMoth->facture_id);
                    if ($facture->etat == 1) 
                    {
                        $tabRecupLastSevenDays[$i]['facturePaye'] += self::sommeFacture($interventionByMoth->id) ;
                    }
                    if ($facture->etat == 2)
                    {
                        $tabRecupLastSevenDays[$i]['chiffreAffaire'] += self::sommeFacture($interventionByMoth->id) ;
                    }
                    
                }
            }
        }
        return $tabRecupLastSevenDays;
    }

    public static function interventionVoitureEnGarages()
    {
        $interventionVoitureEnGarages = Intervention::all();
        return $interventionVoitureEnGarages;
    }
}

<?php

namespace App\Models;

use App\Models\Intervention;
use App\Models\Voiture;
use App\Models\Devi;
use App\Models\Produit;
use App\Models\Devi_produit;
use App\Models\Facture;
use App\Models\Diagnostic;

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

    //CALCULE LA SOMME TOTALE DE LA FACTURE
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
        $diagnostic = Diagnostic::find($intervention->diagnostic_id);
        $sommeFacture += $diagnostic->coût;
        return $sommeFacture;
    }

    //TABLEAU RECAPITULATIF PAR JOUR
    public static function tabRecupDays()
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

    //TABLEAU RECAPITULATIF PAR MOIS
    public static function tabRecupMonths()
    {
        $tabRecupMonths[] = [];
        
        for($i = 0; $i < 5; $i++)
        {
            $date = date('Y-m', (strtotime(date('Y-m'). ' - '.$i.' month')));
            $tabRecupMonths[$i]['date'] = $date;
            $interventions = Intervention::where('created_at','like', $date.'%')->get();
            $tabRecupMonths[$i]['nbIntervention'] = $interventions->count();
            $tabRecupMonths[$i]['facturePaye'] = 0;
            $tabRecupMonths[$i]['chiffreAffaire'] = 0;
            foreach ($interventions as  $intervention) {
                if($intervention->facture_id)
                {
                    $facture = Facture::find($intervention->facture_id);
                    if ($facture->etat == 1) 
                    {
                        $tabRecupMonths[$i]['facturePaye'] += self::sommeFacture($intervention->id) ;
                    }
                    if ($facture->etat == 2)
                    {
                        $tabRecupMonths[$i]['chiffreAffaire'] += self::sommeFacture($intervention->id) ;
                    }
                    
                }
            }
        }
        return $tabRecupMonths;
    }

    //TABLEAU RECAPITULATIF DE CE MOIS
    public static function tabThisMonth()
    {
        $tabThisMonth[] = [];
        
       
            $date = date('Y-m');
            $tabThisMonth['date'] = $date;
            $interventions = Intervention::where('created_at','like', $date.'%')->get();
            $tabThisMonth['nbIntervention'] = $interventions->count();
            $tabThisMonth['facturePaye'] = 0;
            $tabThisMonth['chiffreAffaire'] = 0;
            foreach ($interventions as  $intervention) {
                if($intervention->facture_id)
                {
                    $facture = Facture::find($intervention->facture_id);
                    if ($facture->etat == 1) 
                    {
                        $tabThisMonth['facturePaye'] += self::sommeFacture($intervention->id) ;
                    }
                    if ($facture->etat == 2)
                    {
                        $tabThisMonth['chiffreAffaire'] += self::sommeFacture($intervention->id) ;
                    }
                }
            }
        $tabThisMonth['total'] = $tabThisMonth['facturePaye'] + $tabThisMonth['chiffreAffaire'];
        return $tabThisMonth;
    }

    //LISTE DES VOITURES EN GARAGE
    public static function interventionVoitureEnGarages()
    {
        $interventionVoitureEnGarages = Intervention::all();
        return $interventionVoitureEnGarages;
    }
}

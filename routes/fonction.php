<?php
use App\Models\Facture;
use App\Models\Devi;
function chiffre($mois)
{
    $factures=Facture::with('intervention')->whereMonth('created_at', $mois)->where("etat", 2)->get();

    //Pour le chiffre d'affaire des factures  payer
    $prixHT=0;
    $chiffe_affaires=0;
    // dd($factures->intervention);
    foreach ($factures as $facture) {
        $intervention=$facture->intervention->first();

        if ($intervention->devis_id) {
            $chiffe_affaires+=$intervention->devi->cout+$intervention->diagnostic->coût;
            $devi = Devi::find($intervention->devis_id);
            $les_devis=$devi->produits()->get();
            // dd($le_devis);
            foreach ($les_devis as $le_devi) {
                $prixHT += $le_devi->pivot->quantite * $le_devi->prix1;
            }

        }else{
            $chiffe_affaires+=$intervention->diagnostic->coût;//98 500 000
        }



    }
    $chiffe_affaires+=$prixHT;


    //  Calcule du chiffre d'affaire des impayée
    $factures_impayer=Facture::with('intervention')->whereMonth('created_at', $mois)->where("etat",1)->get();
    $prixHT_imp=0;
    $chiffe_affaires_imp=0;
    foreach ($factures_impayer as $facture) {
        $intervention=$facture->intervention->first();
        if ($intervention->devis_id) {
            $chiffe_affaires_imp+=$intervention->devi->cout+$intervention->diagnostic->coût;
            $devi = Devi::find($intervention->devis_id);
            $les_devis=$devi->produits()->get();

            foreach ($les_devis as $le_devi) {
                $prixHT_imp += $le_devi->pivot->quantite * $le_devi->prix1;
            }

        }else{
            $chiffe_affaires_imp+=$intervention->diagnostic->coût;//98 500 000
        }



    }
    $chiffe_affaires_imp+=$prixHT_imp;

    return ["CA"=>$chiffe_affaires ,"CAI"=>$chiffe_affaires_imp];
}

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
  //AFFICHAGE DU NOMBRE DE PRODUITS QUI SONT DANS LE DEVIS
  function listeProduitDansDevi()
    {
        $listeProduitDevi = 0;
      //  $devis=Devi::all();
      //  $produit=Produit::find($devis->produit_id);
       $devi_produits = Devi_produit::all();
        foreach ($devi_produits as  $devi_produit) {
            if($devi_produit->produit_id )
            {
                $listeProduitDevi = $listeProduitDevi + 1;
                
            }
        }
        return $listeProduitDevi;
    }

  
}

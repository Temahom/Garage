<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

   // protected $table = 'commandes';
   // public $timestamps = true;

   public function devi(){
       return $this->belongsTo(Devi::class);
   }
    
    public function produits()
    {
        return $this->belongsToMany(Produit::class,'commandes');
    }
     
   /* public function produits()
    {
        return $this->belongsToMany(Produit::class,'commande_produits')->withPivot('quantite');
    }*/
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

   // protected $table = 'commandes';
   // public $timestamps = true;

<<<<<<< HEAD
   
    protected $fillable =['produit','etat'];    
   /* protected $fillable = [
        'produit_id',
        'devi_id',
        'qteProduit',
    ];  */
=======
   public function devis(){
       return $this->belongsTo(Devi::class);
   }
>>>>>>> cc0895effdf2df2593f8eb2812c23c60663072cd
    
    public function produits()
    {
        return $this->belongsToMany(Produit::class,'commandes');
    }
     
    public function commande_produits()
    {
        return $this->HasMany(Commande_produit::class);
    }
   /* public function produits()
    {
        return $this->belongsToMany(Produit::class,'commande_produits')->withPivot('quantite');
    }*/
}


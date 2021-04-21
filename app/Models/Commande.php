<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';
    public $timestamps = true;

   
    protected $fillable =['qteProduit ','date_expiaration','etat'];    
   /* protected $fillable = [
        'produit_id',
        'devi_id',
        'qteProduit',
    ];  */
    
    public function produits()
    {
        return $this->belongsToMany(Produit::class,'commandes');
    }
}


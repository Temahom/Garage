<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function devis()
    {
        return $this->belongsToMany(Devi::class,'commandes','devi_id', 'produit_id')->withPivot('qteProduit');
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function produitsByCategorie()
    {
        return Produit::select('produit','id', 'categorie')->where('categorie','=',$this->categorie)->orderBy('produit','asc')->distinct()->get();
    }

    public function approvisionnements()
    {
        return $this->belongsToMany(Approvisionnement::class)->withPivot('quantite');
    }
}

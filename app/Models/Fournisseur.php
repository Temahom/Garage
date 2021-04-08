<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = ['nom','prenom','genre','entreprise','telephone','email'];

    public function approvisionnement()
    {
        return $this->hasMany(Approvisionnement::class);
    }

  /*   public function produits()
    {
       return $this->hasMany('App\Models\Produit');
    }         */
}

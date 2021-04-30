<?php

namespace App\Models;

use App\Models\Commande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Devi extends Model
{
    use HasFactory;
    protected $fillable =['cout ', 'produit ','date_expiaration','etat'];
    public function intervention()
    {
        return $this->hasMany(Intervention::class);
    }
    public function devi_produits()
    {
        return $this->HasMany(Devi_produit::class);
    }
    public function produits()
    {
        return $this->belongsToMany(Produit::class,'devi_produits')->withPivot('quantite');
    }
    public function facture()
    {
        return $this->hasMany(Facture::class);
    }
    public function commande()
    {
        return $this->hasMany(Commande::class);
    }
}

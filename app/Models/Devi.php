<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

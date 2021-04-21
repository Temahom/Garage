<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approvisionnement extends Model
{
    use HasFactory;

    protected $table = 'approvisionnements';
    public $timestamps = true;

    protected $fillable = [
        'produit_id',
        'qteAppro',
        'prixAchat',
        'fournisseur_id',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
    public function produits()
    {
        return $this->belongsToMany(Produit::class)->withPivot('quantite');
    }

}
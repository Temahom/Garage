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
        'fournisseur',
        'nomProduit',
        'qteTotale',
        'prixTotal',
        'cost'
    ];
}
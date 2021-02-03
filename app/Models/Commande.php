<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';
    public $timestamps = true;

    protected $fillable = [
        'catProduit',
        'nomProduit',
        'qteProduit',
    ];
}
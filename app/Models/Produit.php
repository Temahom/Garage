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
     return $this->belongsToMany(Devi::class,'devi_produit','devi_id', 'produit_id');
    }

}

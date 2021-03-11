<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['nom','prenom','genre','entreprise','telephone','email'];
    public function voitures()
    {
       return $this->hasMany('App\Models\Voiture');
    }
    public function user()
    {
       return $this->belongsTo('App\Models\User');
    }
}

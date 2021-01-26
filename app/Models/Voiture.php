<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{
    protected $guarded=[];
    use HasFactory;

    public function client(){
        return $this->belongsTo("App\Models\Client");
    }

    public function interventions()
    {
      return $this->hasMany(Intervention::class);
    }
}

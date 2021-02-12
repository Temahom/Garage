<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function voiture()
    {
        return $this->belongsTo(Voiture::class, 'voiture_id');
    }
    public function diagnostic()
    {
        return $this->belongsTo(Diagnostic::class);
    }
    public function devi()
    {
        return $this->belongsTo(Devi::class,'devis_id');
    }
    public function reparation()
    {
        return $this->belongsTo(Reparation::class);
    }
    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
}

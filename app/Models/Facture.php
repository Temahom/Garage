<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    public function intervention()
    {
        return $this->hasMany(Intervention::class);
    }
    public function diagnostic()
    {
        return $this->belongsTo(Diagnostic::class);
    }
    public function devi()
    {
        return $this->belongsTo(Devi::class);
    }
}

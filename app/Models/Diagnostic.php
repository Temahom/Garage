<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;
    protected $fillable = [
        'constat','coût'
    ];
    public function intervention()
    {
        return $this->hasMany(Intervention::class);
    }
    public function defauts()
    {
        return $this->hasMany(Defaut::class);
    }
    public function facture()
    {
        return $this->hasMany(Facture::class);
    }
}

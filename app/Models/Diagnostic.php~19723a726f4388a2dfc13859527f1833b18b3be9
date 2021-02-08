<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    
    protected $fillable = [
        'description',
    ];
    public function intervention()
    {
        return $this->hasMany(Intervention::class);
    }
}

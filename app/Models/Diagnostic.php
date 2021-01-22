<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    
    protected $fillable = [
        'date',
        'description',
    ];
}

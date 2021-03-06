<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defaut extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function intervention()
    {
        return $this->belongsTo(Intervention::class);
    }
}

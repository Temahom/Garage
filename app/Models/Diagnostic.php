<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','description'
    ];
    public function intervention()
    {
        return $this->hasMany(Intervention::class);
    }
}

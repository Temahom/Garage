<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparation extends Model
{
    use HasFactory;

    protected $table = 'reparations';
    public $timestamps = true;


    protected $fillable = [
        'element_3'   
    ];
    public function intervention()
    {
        return $this->hasMany(Intervention::class);
    }
}

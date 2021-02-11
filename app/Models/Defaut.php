<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Erreurdiag extends Model
{
    protected $table = 'defauts';
    use HasFactory;

    protected $fillable = [
        'code',
        'categorie',
        'localisation',
        'description',
        'etat'];
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function voitures()
    {
        return $this->hasMany(Voiture::class);
    }
    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
    public function passer_commande(){
        return $this->hasMany(Commande::class,'passer_par');
    }
    public function valider_commande(){
        return $this->hasMany(Commande::class,'valide_par');
    }
}

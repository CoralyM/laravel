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

    public function ILikeThem() {
        return $this->belongsToMany("App\Models\User", "connexion", "from_id", "to_id");
        // SEELECT * FROM users JOIN connection ON to_id=users.id WHERE from_id=$this->id
    }

    public function TheyLikeMe() {
        return $this->belongsToMany("App\Models\User", "connexion", "to_id", "from_id");
        // SEELECT * FROM users JOIN connection ON from_id=users.id WHERE to_id=$this->id
    }

    public function songs(){
        return $this->hasMany("App\Models\Song", "user_id");
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['username', 'password', 'name', 'grade', 'class', 'number'];
    protected $hidden = ['password'];

    public function wallet()
    {
        return $this->hasOne('App\Models\Wallet');
    }

    public function cards()
    {
        return $this->hasMany('App\Models\Card');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function registers()
    {
        return $this->hasMany('App\Models\Register');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Register extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'token'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

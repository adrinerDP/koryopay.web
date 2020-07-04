<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $fillable = ['fingerprint', 'card_id'];

    public function card()
    {
        return $this->belongsTo('App\Models\Card');
    }
}

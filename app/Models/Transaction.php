<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = ['wallet_id', 'card_id', 'activity_id', 'amount', 'type'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function wallet()
    {
        return $this->belongsTo('App\Models\Wallet');
    }

    public function card()
    {
        return $this->belongsTo('App\Models\Card');
    }

    public function activity()
    {
        return $this->belongsTo('App\Models\Activity');
    }
}

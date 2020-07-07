<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Card;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function update(Request $request)
    {
        if (\App\Libraries\Activity::isLocked()) {
            return 'LOCKED';
        }
        $card_id = $this->getCardId($request->fingerprint);
        Activity::create([
            'fingerprint' => $request->fingerprint,
            'card_id' => $card_id
        ]);
        if (!$card_id) {
            return 'UNREGISTERED';
        }
        return 'UPDATED';
    }

    private function getCardId($fingerprint)
    {
        $card = Card::where('fingerprint', $fingerprint)->first();
        if (!$card) {
            return null;
        } else {
            return $card->id;
        }
    }
}

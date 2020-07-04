<?php

namespace App\Libraries;

use App\Models\Wallet;
use App\Models\Activity;
use RealRashid\SweetAlert\Facades\Alert;

class Transaction {
    public function makeTransaction(Activity $activity, int $amount, int $type)
    {
        switch ($type) {
            case -2:
            case 1:
                return $this->performPositiveTransaction($activity, $amount, $type);
                break;
            case -1:
            case 2:
                return $this->performNegativeTransaction($activity, $amount, $type);
                break;
            default:
                return false;
        }
    }

    private function performPositiveTransaction(Activity $activity, int $amount, int $type)
    {
        $wallet = $activity->card->user->wallet;
        $this->createTransaction($wallet, $activity, $amount, $type);
        $wallet->balance = $wallet->balance + $amount;
        $wallet->update();
        $activity->delete();
        return true;
    }

    private function performNegativeTransaction(Activity $activity, int $amount, int $type)
    {
        $wallet = $activity->card->user->wallet;
        if ($amount > $wallet->balance) {
            $activity->delete();
            Alert::error('잔액이 부족합니다');
            return false;
        } else {
            $this->createTransaction($wallet, $activity, $amount, $type);
            $wallet->balance = $wallet->balance - $amount;
            $wallet->update();
            $activity->delete();
            return true;
        }
    }

    private function createTransaction(Wallet $wallet, Activity $activity, int $amount, int $type) {
        return \App\Models\Transaction::create([
            'wallet_id' => $wallet->id,
            'card_id' => $activity->card->id,
            'activity_id' => $activity->id,
            'amount' => $amount,
            'type' => $type
        ]);
    }
}

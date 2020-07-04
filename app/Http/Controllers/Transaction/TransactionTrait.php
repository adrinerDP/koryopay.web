<?php

namespace App\Http\Controllers\Transaction;

use App\Libraries\Activity;
use App\Libraries\Transaction;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

trait TransactionTrait {
    private string $view;
    private int $type;
    private string $message;

    public function home()
    {
        Activity::lock();
        return Activity::getActivityAndMakeView($this->view);
    }

    public function proceed(Request $request)
    {
        $transaction = new Transaction();
        $result = $transaction->makeTransaction(Activity::getLatestActivity(), $request->amount, $this->type);
        if($result) {
            Alert::success($this->message);
        }
        Activity::unlock();
        return redirect()->route('home');
    }
}

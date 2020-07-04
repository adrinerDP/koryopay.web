<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Transaction;
use App\Libraries\Transaction as Logger;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    private Logger $logger;

    public function __construct()
    {
        $this->logger = new Logger();
    }

    public function rollback($id)
    {
        $transaction = Transaction::find($id);
        if (is_null($transaction)) {
            Alert::error('오류', '거래를 찾을 수 없습니다!');
            return redirect()->route('home');
        }
        $activity = Activity::withTrashed()->find($transaction->activity_id);
        $this->logger->makeTransaction($activity, $transaction->amount, -$transaction->type);
        $transaction->delete();
        Alert::success('거래 취소 완료', sprintf('%s - %s원',
            \App\Libraries\Helper::getHumanType($transaction->type), $transaction->amount))->autoClose(false);
        return redirect()->route('home');
    }
}

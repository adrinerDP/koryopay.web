<?php

namespace App\Http\Controllers;

use App\Libraries\Activity;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ContentController extends Controller
{
    public function home()
    {
        $user = Auth::user();

        if (!$user->is_admin) {
            return view('pages.home.user', [
                'balance' => number_format($user->wallet->balance),
                'transactions' => $user->wallet->transactions()->withTrashed()->latest()->take(5)->get(),
                'cards' => $user->cards()->get(),
                'comment' => sprintf('%s학년 %s반 %s번', Auth::user()->grade, Auth::user()->class, Auth::user()->number),
            ]);
        } else {
            return view('pages.home.admin');
        }
    }

    public function unlock()
    {
        Alert::success('입력 제한 해제 완료', '카드 재입력 제한이 해제되었습니다.');
        Activity::unlock();
        return redirect()->route('home');
    }
}

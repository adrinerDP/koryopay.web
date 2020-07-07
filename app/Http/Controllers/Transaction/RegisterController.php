<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Libraries\Activity;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    public function issueToken()
    {
        $token = Register::firstOrCreate([
            'user_id' => Auth::user()->id
        ], [
            'token' => rand(100000, 999999)
        ]);

        return view('pages.issue', compact('token'));
    }

    public function checkFingerprint()
    {
        $activity = Activity::getLatestActivity();
        Activity::lock();
        if (Activity::checkActivityDeleted($activity)) {
            Alert::warning('카드 입력 요망', '카드 입력 시간이 초과되었거나, 인식되지 않았습니다.');
            return $this->revokeAndUnlock();
        }
        if (Activity::checkRegisteredCard($activity)) {
            Alert::error('이미 등록된 카드입니다');
            return $this->revokeAndUnlock();
        }
        return view('pages.register');
    }

    public function saveFingerprint(Request $request)
    {
        $register = Register::where('token', $request->input('token'))->first();
        if (!$register) {
            Alert::error('인증번호 오류', '해당하는 인증번호가 없습니다');
            return $this->revokeAndUnlock();
        }
        $card = $register->user->cards()->create([
            'is_student_id' => !$request->has('is_student_id'),
            'fingerprint' => Activity::getLatestActivity()->fingerprint,
        ]);
        $register->delete();
        Activity::unlock();
        Alert::success('카드 등록 완료', sprintf('%s학년 %s반 %s번 %s의 카드 등록이 완료되었습니다', $card->user->grade, $card->user->class, $card->user->number, $card->user->name));
        return redirect()->route('home');
    }

    private function revokeAndUnlock()
    {
        Activity::revokeLatestActivity();
        Activity::unlock();
        return redirect()->route('home');
    }
}

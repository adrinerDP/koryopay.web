<?php

namespace App\Libraries;

use App\Models\Activity as Fingerprint;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;

class Activity {
    public static function getActivityAndMakeView(string $view, bool $delete_activity = false, bool $check_student_id = true)
    {
        $activity = self::getLatestActivity();

        if (!self::validate($activity)) return redirect()->route('home');
        if ($check_student_id) self::checkStudentIdCard($activity);
        if ($delete_activity) $activity->delete();

        return view($view, compact('activity'));
    }

    public static function getLatestActivity()
    {
        return Fingerprint::withTrashed()->latest()->first();
    }

    public static function revokeLatestActivity()
    {
        $activity = self::getLatestActivity();
        $activity->delete();
        return true;
    }

    public static function validate(Fingerprint $activity)
    {
        if (self::checkActivityDeleted($activity)) {
            Alert::warning('카드 입력 요망', '카드 입력 시간이 초과되었거나, 인식되지 않았습니다.');
            self::unlock();
            return false;
        }
        if (!self::checkRegisteredCard($activity)) {
            Alert::error('미등록 카드', '카드가 고려페이 시스템에 등록되어 있지 않습니다.');
            self::unlock();
            return false;
        }
        return true;
    }

    public static function isLocked()
    {
        if (Cache::get('is_locked')) {
            return true;
        }
        return false;
    }

    public static function lock() {
        return Cache::forever('is_locked', true);
    }

    public static function unlock()
    {
        return Cache::forever('is_locked', false);
    }

    public static function checkActivityDeleted(Fingerprint $activity)
    {
        if ($activity->created_at->diffInSeconds(Carbon::now()) > 60 || $activity->deleted_at) {
            return true;
        }
        return false;
    }

    public static function checkRegisteredCard(Fingerprint $activity)
    {
        if (is_null($activity->card)) {
            return false;
        }
        return true;
    }

    public static function checkStudentIdCard(Fingerprint $activity)
    {
        if (!$activity->card->is_student_id) {
            Alert::question('본인 확인 필요', '인식된 카드가 학생증이 아닙니다.')
                ->showConfirmButton('계속 진행', '#3742fa')
                ->showCancelButton('취소', '#e84393');
        }
    }
}

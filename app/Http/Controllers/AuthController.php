<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('username', $request->username)->first();

        if (!$user) return $this->failLogin();
        if (!Hash::check($request->password, $user->password)) return $this->failLogin();

        Auth::login($user);
        Alert::success('로그인 되었습니다.', '');

        return redirect()->route('home');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'grade' => $request->grade,
            'class' => $request->class,
            'number' => $request->number,
        ]);

        Wallet::create([
            'user_id' => $user->id,
            'balance' => 0,
        ]);

        Alert::success('회원가입 되었습니다.', '');
        return redirect()->route('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        Alert::success('로그아웃 되었습니다', '');
        return redirect()->route('auth.login');
    }

    private function failLogin()
    {
        Alert::error('로그인 실패', '아이디나 비밀번호를 확인하세요!');
        return redirect()->back();
    }
}

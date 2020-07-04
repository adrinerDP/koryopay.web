@extends('layouts.app')

@section('title', '카드 등록 신청')

@section('comment', '본인 인증을 위한 인증번호를 발급합니다')

@section('content')
    <article id="register">
        <div class="alert alert-info font-weight-bold text-center mb-5" role="alert">
            카드 등록을 위한 개인 인증 번호 6자리가 발급되었습니다.
        </div>
        <div class="row token mb-5">
            @foreach(str_split($token->token) as $digit)
                <div class="col">
                    <div class="digit">
                        {{ $digit }}
                    </div>
                </div>
            @endforeach
        </div>
        <div class="alert alert-secondary" role="alert">
            <h5 class="font-weight-bold mb-2"><i class="fa fa-angle-right"></i> 카드 등록 방법 안내</h5>
            <ul class="m-0 pl-4">
                <li>위의 인증번호 6자리를 기억하세요.</li>
                <li>관리자에게 카드 등록 의사를 밝혀주세요.</li>
                <li>카드를 단말기에 접촉한 후, 인증번호를 알려주세요.</li>
                <li>만약, 학생증이 아닌 경우 본인 인증 수단을 준비하세요.</li>
            </ul>
        </div>
    </article>
@endsection

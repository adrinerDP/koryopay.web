@extends('layouts.app')

@section('title', '카드 등록 처리')

@section('comment')
    카드 소유자와 신청자를 <span class="font-weight-bold">반드시</span> 확인하세요<br>
    학생에게 받은 <span class="font-weight-bold">6자리 인증 번호</span>를 입력하세요
@endsection

@section('content')
    <article id="register" style="margin-top: -1.25rem;">
        <form action="{{ route('register.proceed') }}" id="with-numpad" method="post">
            @csrf
            <input type="number" id="with-numpad" name="token" class="form-control text-center mb-2" maxlength="6">
            <div class="form-check p-0">
                <input type="checkbox" class="form-check-input" name="is_student_id" value="1">
                <span class="font-weight-bold">학생증이 아닌 기타카드인 경우 체크하세요.</span>
            </div>
        </form>
    </article>
    @include('components.numpad')
@endsection

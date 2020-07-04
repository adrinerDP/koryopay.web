@extends('layouts.app')

@section('title', '회원가입')

@section('content')
    <article id="register" class="px-5 pb-5">
        <p>* 표시는 필수 입력 항목입니다.</p>
        {!!Form::open()->autocomplete('off')!!}
        {!!Form::text('username', '아이디*')->required()!!}
        {!!Form::text('password', '비밀번호*')->type('password')->required()!!}
        {!!Form::text('password_confirmation', '비밀번호 확인*')->type('password')->required()!!}
        {!!Form::text('name', '이름*')->required()!!}
        {!!Form::text('grade', '학년')->type('number')!!}
        {!!Form::text('class', '반')->type('number')!!}
        {!!Form::text('number', '번호')->type('number')!!}
        {!!Form::submit('회원가입')->info()->block()->lg()!!}
        {!!Form::close()!!}
    </article>
@endsection

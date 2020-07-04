@extends('layouts.app')

@section('title', '로그인')

@section('content')
    <article id="login" class="px-5 pb-5">
        {!!Form::open()->autocomplete('off')!!}
        {!!Form::text('username', '아이디*')->required()!!}
        {!!Form::text('password', '비밀번호*')->type('password')->required()!!}
        {!!Form::submit('로그인')->dark()->block()->lg()!!}
        <a href="{{ route('auth.register') }}" class="btn btn-block btn-outline-dark">회원가입</a>
        {!!Form::close()!!}
    </article>
@endsection

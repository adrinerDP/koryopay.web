@extends('layouts.app')

@section('title', '대기중')

@section('content')
    <article id="home">
        <div class="alert alert-info font-weight-bold text-center" role="alert">
            단말기에 카드를 접촉 한 뒤 아래 버튼을 눌러주세요.
        </div>
        <div class="row">
            <div class="col">
                <a href="{{ route('pay.home') }}" class="btn btn-outline-dark action"><i class="fa fa-check"></i> 결제</a>
            </div>
            <div class="col">
                <a href="{{ route('charge.home') }}" class="btn btn-outline-dark action"><i class="fa fa-plus-square"></i> 충전</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{ route('lookup.home') }}" class="btn btn-outline-dark action"><i class="fa fa-search"></i> 조회</a>
            </div>
            <div class="col">
                <a href="{{ route('register.home') }}" class="btn btn-outline-dark action"><i class="fa fa-user-plus"></i> 등록</a>
            </div>
        </div>
        <div class="alert alert-success font-weight-bold text-center mt-3" role="alert">
            결제중단·인식불능시 아래 버튼으로 상태를 초기화 하세요.
        </div>
        <a href="{{ route('unlock') }}" class="btn btn-block btn-outline-danger">
            <i class="fa fa-unlock-alt"></i> 카드 입력 상태 재설정
        </a>
    </article>
@endsection

@extends('layouts.app')

@section('title', Auth::user()->name)
@section('comment', $comment)

@section('content')
    <article id="home">
        <a href="#" class="btn btn-dark btn-block mb-3">거래 내역 상세 조회</a>
        <a href="{{ route('register.user') }}" class="btn btn-dark btn-block mb-3">카드 등록</a>
        <div class="card mb-3">
            <div class="card-header">
                지갑 잔액
            </div>
            <div class="card-body text-center py-3">
                <h3 class="m-0">
                    <span class="font-weight-bold">{{ $balance }}</span>
                    <small class="text-muted"><i class="fa fa-won"></i></small>
                </h3>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                최근 거래 내역 (5건)
            </div>
            <div class="card-body p-0">
                <ul class="list-group">
                    @forelse($transactions as $transaction)
                        <li class="list-group-item">
                            @if($transaction->trashed())<del data-toggle="tooltip" data-placement="top" title="{{ $transaction->deleted_at->format('Y-m-d H:i:s') }}에 거래 취소됨">@endif
                            <span class="font-weight-bold">
                                {{ \App\Libraries\Helper::getHumanType($transaction->type)}} {{number_format($transaction->amount) }}원
                            </span>
                            <span class="fa-pull-right">{{ $transaction->created_at->diffForHumans() }}</span>
                            @if($transaction->trashed())</del>@endif
                        </li>
                    @empty
                        <li class="list-group-item text-center py-3">
                            <h2 class="mb-2 font-weight-bold text-danger">:(</h2>
                            <h5 class="mb-2 font-weight-bold">아직 고려페이를 이용하지 않으셨네요</h5>
                            <p class="m-0">카드 등록 후 편리한 결제를 누려보세요.</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="card mb-3 border-bottom-0">
            <div class="card-header">
                내 카드
            </div>
            @forelse($cards as $card)
                <div class="card-body border-bottom">
                    <h3 class="font-weight-bold mb-2">
                        @if($card->is_student_id)<i class="fa fa-id-card"></i>@else<i class="fa fa-credit-card"></i>@endif
                        {{ $card->fingerprint }}
                    </h3>
                    <p class="m-0">
                        <span class="font-weight-bold">카드 유형:</span>
                        @if($card->is_student_id) <span class="text-success font-weight-bold">학생증</span>@else기타카드@endif
                    </p>
                    <p class="m-0">
                        <span class="font-weight-bold">카드 등록 일시:</span>
                        {{ $card->created_at->format('Y-m-d H:i:s') }}
                    </p>
                </div>
            @empty
                <div class="card-body border-bottom text-center py-3">
                    <h2 class="mb-2 font-weight-bold text-danger">:(</h2>
                    <h5 class="mb-2 font-weight-bold">아직 카드를 등록하지 않으셨네요</h5>
                    <p class="m-0">카드 등록 후 편리한 결제를 누려보세요.</p>
                </div>
            @endforelse
        </div>
    </article>
@endsection

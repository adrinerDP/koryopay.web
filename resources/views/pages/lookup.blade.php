@extends('layouts.app')

@section('title', '카드 상세 조회')

@section('comment', $activity->card->user->name)

@section('content')
    <article id="lookup">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-info-circle"></i> 잔액 정보
            </div>
            <div class="card-body text-center py-2">
                <h2 class="m-0 font-weight-bold">
                    {{ number_format($activity->card->user->wallet->balance) }}원
                </h2>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-info-circle"></i> 카드 소유자 정보
            </div>
            <div class="card-body text-center">
                <h3 class="mb-2 font-weight-bold">
                    {{ $activity->card->user->grade }}학년
                    {{ $activity->card->user->class }}반
                    {{ $activity->card->user->number }}번
                    {{ $activity->card->user->name }}
                </h3>
                <p class="m-0">시스템 등록일시: {{ $activity->card->user->created_at->format('Y년 m월 d일 H:i:s') }}</p>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-info-circle"></i> 카드 고유 정보
            </div>
            <div class="card-body text-center">
                @if($activity->card->is_student_id)
                    <h4 class="mb-2 text-success font-weight-bold"><i class="fa fa-check"></i> 학생증입니다.</h4>
                @else
                    <h4 class="mb-2 text-danger font-weight-bold"><i class="fa fa-times"></i> 기타카드입니다.</h4>
                @endif
                <h3 class="mb-2 font-weight-bold">
                    {{ $activity->card->fingerprint }}
                </h3>
                <p class="m-0">카드 등록일시: {{ $activity->card->created_at->format('Y년 m월 d일 H:i:s') }}</p>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-list"></i> 최근 거래 내역 (10건)
            </div>
            <div class="list-group p-0">
                @forelse($activity->card->transactions()->withTrashed()->latest()->take(10)->get() as $transaction)
                    <li class="list-group-item">
                        @if($transaction->trashed())
                            <del>
                        @endif
                        <div class="mb-1">
                            <span class="font-weight-bold">
                                {{ \App\Libraries\Helper::getHumanType($transaction->type)}} {{number_format($transaction->amount) }}원
                            </span>
                            <span class="fa-pull-right">{{ $transaction->created_at->format('Y-m-d H:i:s') }}</span>
                        </div>
                        @if(!$transaction->trashed())
                            <a href="{{ route('transaction.rollback', $transaction->id) }}" class="btn btn-outline-danger fa-pull-right btn-sm">
                                <i class="fa fa-redo-alt"></i> 거래 취소
                            </a>
                        @endif
                        @if($transaction->trashed())
                            </del>
                            <div class="text-right">{{ $transaction->deleted_at->format('Y-m-d H:i:s') }}에 거래 취소됨</div>
                        @endif
                    </li>
                @empty
                    <li class="list-group-item text-center py-3">
                        <h2 class="mb-2 font-weight-bold text-danger">:(</h2>
                        <h5 class="mb-2 font-weight-bold">이용 기록이 없습니다.</h5>
                    </li>
                @endforelse
            </div>
        </div>
    </article>
@endsection

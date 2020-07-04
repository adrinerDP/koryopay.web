@extends('layouts.app')

@section('title', '충전')

@section('content')
    <article id="pay">
        <form action="{{ route('charge.proceed') }}" id="with-numpad" method="post">
            @csrf
            <div class="input-group">
                <input type="number" name="amount" id="with-numpad" class="form-control">
                <span class="input-group-addon">원</span>
            </div>
        </form>
    </article>
    @include('components.numpad')
@endsection

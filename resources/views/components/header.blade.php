<section class="toolbar">
    <div class="row">
        <div class="col-6 text-left">
            <a href="{{ route('home') }}" class="font-weight-bold">고려페이</a>
        </div>
        <div class="col-6 text-right">
            @if(Auth::check())
                <span class="mr-2">
                    <i class="fa fa-user"></i> {{ Auth::user()->name }}
                </span>
                <a href="{{ route('auth.logout') }}">
                    <i class="fa fa-sign-out"></i> 로그아웃
                </a>
            @else
                <a href="{{ route('auth.login') }}">
                    <i class="fa fa-sign-in-alt"></i> 로그인
                </a>
            @endif
        </div>
    </div>
</section>
<header>
    <h1>@hasSection('title') @yield('title') @else {{ config('app.name') }} @endif</h1>
    <h5>@hasSection('comment') @yield('comment') @else {{ config('app.name') }} @endif</h5>
</header>

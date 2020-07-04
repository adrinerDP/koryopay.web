<!doctype html>
<html lang="ko">
<head>
    <!-- META -->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@hasSection('title') @yield('title') ::@endif {{ config('app.name') }}</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    @yield('css')

    <!-- JS -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://kit.fontawesome.com/a789b2e75a.js" crossorigin="anonymous"></script>
    @yield('js')
</head>
<body>
<div class="container">
    @include('components.header')
    @yield('content')
</div>
@include('sweetalert::alert')
</body>
</html>

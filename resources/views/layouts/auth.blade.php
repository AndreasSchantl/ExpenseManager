<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.head')
    <title>@yield('title') - {{ __('app.APP_NAME') }}</title>
</head>
<body class="login">

<div class="container d-flex justify-content-center">
    <div class="col-md-4 align-self-center">
        <div class="card" id="app">
            <a href="{{ route('login') }}"><img class="card-img-top login-logo p-3" src="{{ asset('images/logo.svg') }}" alt="Logo"></a>
            @yield('content')
        </div>
    </div>
</div>

@yield('scripts')
</body>
</html>
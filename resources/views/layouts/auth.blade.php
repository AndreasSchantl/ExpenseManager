<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.head')
    <title>@yield('title') - {{ __('app.APP_NAME') }}</title>
</head>
<body class="w-full h-full bg-gray-100 flex items-center justify-center">

<div class="w-full max-w-sm">
    <div class="col-md-4 align-self-center">
        <a href="{{ route('login') }}">
            <img  src="{{ asset('images/logo.svg') }}" alt="Logo">
        </a>
        <div class="rounded p-3 mt-8" id="app">
            @yield('content')
        </div>
    </div>
</div>

@yield('scripts')
</body>
</html>
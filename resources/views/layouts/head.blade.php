<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="theme-color" content="#19de8b">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="application-name" content="{{ __('app.APP_NAME') }}">
<meta name="apple-mobile-web-app-title" content="{{ __('app.APP_NAME') }}">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="icon" href="{{ asset('images/favicon.png') }}">
<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/solid.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/fontawesome.css" crossorigin="anonymous">
<script src="{{ asset('js/app.js') }}" defer></script>

<title>@yield('title') - {{ __('app.APP_NAME') }}</title>
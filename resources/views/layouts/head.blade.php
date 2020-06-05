<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="theme-color" content="#19de8b">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="application-name" content="{{ __('app.APP_NAME') }}">
<meta name="apple-mobile-web-app-title" content="{{ __('app.APP_NAME') }}">
<link href="{{ mix('css/app.css') }}" rel="stylesheet">
<link rel="apple-touch-icon" href="{{ asset('images/apple_touch_icon.png') }}">
<link rel="icon" href="{{ asset('images/favicon.png') }}">
<script>
    if (('standalone' in navigator) && navigator.standalone) {
        document.addEventListener('click', function(e) {
            var curnode = e.target
            while (!(/^(a|html)$/i).test(curnode.nodeName)) {
                curnode = curnode.parentNode
            }
            if ('href' in curnode
                && (chref = curnode.href).replace(document.location.href, '').indexOf('#')
                && (!(/^[a-z\+\.\-]+:/i).test(chref)
                || chref.indexOf(document.location.protocol + '//' + document.location.host) === 0)
            ) {
                e.preventDefault()
                document.location.href = curnode.href
            }
        }, false)
    }
</script>
<script src="{{ mix('js/app.js') }}" defer></script>

<title>@yield('title') - {{ __('app.APP_NAME') }}</title>
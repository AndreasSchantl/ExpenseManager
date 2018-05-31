<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.head')
</head>
<body>
<main class="container py-4 mb-5" id="app">
    <div class="card p-4" style="overflow-x: auto;">
        @if (session('info'))
            <div class="alert alert-warning alert-dismissible no-print" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    &times;
                </button>
                {{ session('info') }}
            </div>
        @endif

        @if(!$errors->isEmpty())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible no-print" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        &times;
                    </button>
                    {{ $error }}
                </div>
            @endforeach
        @endif

        @yield('content')
    </div>
</main>

<nav class="navbar navbar-expand-md navbar-light navbar-expensemanager fixed-bottom">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/expenses') }}">
            <img src="{{ asset('images/logo.svg') }}" style="height: 2rem;" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @yield('left_sidebar')

            {{-- Right Side Of Navbar --}}
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropup">
                    <a id="navbarDropup" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ __('app.navigation_settings') }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="{{ url('users') }}" class="dropdown-item">{{ __('app.users') }}</a>
                        <a href="{{ url('expensetypes') }}" class="dropdown-item">{{ __('app.exp_types') }}</a>
                    </div>
                </li>
                <li class="nav-item dropup">
                    <a id="navbarDropup" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->fname }} {{ Auth::user()->lname }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('app.navigation_logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
</body>
</html>

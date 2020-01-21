<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.head')
</head>
<body class="h-full w-full bg-gray-100">
<main class="container mx-auto flex flex-col" id="app">
    <nav class="flex items-center flex-wrap container self-center md:h-16 md:px-0 px-4">
        <div class="flex md:w-3/12 w-1/2 md:pt-0 pt-4">
            <a class="navbar-brand" href="{{ url('/expenses') }}">
                <img src="{{ asset('images/logo.svg') }}" style="height: 2rem;" alt="Logo">
            </a>
        </div>
        <div class="md:flex w-8/12 hidden">
            @yield('middle_menu')
        </div>
        <div class="flex md:w-1/12 w-1/2 md:py-0 py-4">
            <div class="flex w-full items-center justify-end h-full">
                <a class="mr-4" href="{{ url('expensetypes') }}" title="{{ __('app.exp_types') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 icon-swatch">
                        <path class="primary" d="M9 22c.19-.14.37-.3.54-.46L17.07 14H20a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H9zM4 2h4a2 2 0 0 1 2 2v14a4 4 0 1 1-8 0V4c0-1.1.9-2 2-2zm2 17.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                        <path class="secondary" d="M11 18.66V7.34l2.07-2.07a2 2 0 0 1 2.83 0l2.83 2.83a2 2 0 0 1 0 2.83L11 18.66z"></path>
                    </svg>
                </a>
                <a class="mr-4" href="{{ url('users') }}" title="{{ __('app.users') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 icon-user-couple">
                        <path class="primary" d="M15 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm7 8a2 2 0 0 1-2 2H10a2 2 0 0 1-2-2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"></path>
                        <path class="secondary" d="M9 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm7 8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"></path>
                    </svg>
                </a>
                <a href="{{ route('logout') }}"
                    title="{{ __('app.navigation_logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 icon-lock">
                        <path class="primary" d="M5 10h14a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2zm6 6.73V18a1 1 0 0 0 2 0v-1.27a2 2 0 1 0-2 0z"></path>
                        <path class="secondary" d="M12 19a1 1 0 0 0 1-1v-1.27A2 2 0 0 0 12 13v-3h3V7a3 3 0 0 0-6 0v3H7V7a5 5 0 1 1 10 0v3h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-7v-3z"></path>
                    </svg>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
        <div class="flex w-full md:hidden py-2 items-center">
            @yield('middle_menu')
        </div>
    </nav>

    @if (session('info'))
        <div class="bg-teal-200 text-teal-800 rounded w-full text-center border border-teal-400 p-2 mb-3" role="alert">
            {{ session('info') }}
        </div>
    @endif

    @if(!$errors->isEmpty())
        @foreach($errors->all() as $error)
            <div class="bg-red-200 text-red-800 rounded w-full text-center border border-red-400 p-2 mb-3" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    @yield('content')
</main>
</body>
</html>

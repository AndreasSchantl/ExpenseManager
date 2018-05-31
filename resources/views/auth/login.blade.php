@extends('layouts.auth')

@section('title', __('app.login'))

@section('content')
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            @csrf

            @if(!$errors->isEmpty())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            @if(session('info'))
                <div class="alert alert-warning" role="alert">
                    {{ session('info') }}
                </div>
            @endif

            <div class="form-group">
                <input id="username" type="text" class="form-control" name="username"
                       placeholder="{{ __('app.username') }}"
                       value="{{ old('username') }}" required autofocus>
            </div>

            <div class="form-group">
                <input id="password" type="password" class="form-control" name="password"
                       placeholder="{{ __('app.user_password') }}" required>
            </div>

            <div class="form-group">
                <div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">{{ __('app.login_keep_logged_in') }}</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-primary font-weight-bold text-white">
                        {{ __('app.login_action') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
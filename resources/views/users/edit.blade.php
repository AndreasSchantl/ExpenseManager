@extends('layouts.app')

@section('title', __('app.user_update'))

@section('content')
    <h1>{{ __('app.user_update') }}</h1>

    <form action="/users/{{ $user->id }}" method="post">
        @method('put')
        @csrf
        <div class="form-row mt-3">
            <div class="col-md-4">
                <input title="{{ __('app.username') }}" type="text" name="username" placeholder="vorname.nachname" value="{{ $user->username }}" class="form-control">
                <small>{{ __('app.username') }}</small>
            </div>
            <div class="col-md-4">
                <input title="{{ __('app.user_fname') }}" type="text" name="fname" placeholder="Hans" value="{{ $user->fname }}" class="form-control">
                <small>{{ __('app.user_fname') }}</small>
            </div>
            <div class="col-md-4">
                <input title="{{ __('app.user_lname') }}" type="text" name="lname" placeholder="Mayer" value="{{ $user->lname }}" class="form-control">
                <small>{{ __('app.user_lname') }}</small>
            </div>
        </div>
        <div class="form-row mt-3">
            <div class="col-md-6">
                <input title="{{ __('app.user_password') }}" type="password" name="password" placeholder="{{ __('app.user_password') }}" class="form-control">
                <small>{{ __('app.user_password') }} | {{ __('app.user_leave_empty') }}</small>
            </div>
            <div class="col-md-6">
                <input title="{{ __('app.user_password_repeat') }}" type="password" name="password-repeat" placeholder="{{ __('app.user_password') }}" class="form-control">
                <small>{{ __('app.user_password_repeat') }}</small>
            </div>
        </div>
        <div class="form-row mt-3">
            <button class="btn btn-primary font-weight-bold text-white">{{ __('app.misc_update') }}</button>
        </div>
    </form>
@endsection
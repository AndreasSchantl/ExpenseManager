@extends('layouts.app')

@section('title', __('app.user_update'))

@section('content')
    <h1 class="font-bold text-2xl md:mx-0 mx-4">{{ __('app.user_update') }}</h1>

    <form action="/users/{{ $user->id }}" method="post" class="mx-4 md:mx-0">
        @method('put')
        @csrf
        <div class="flex md:flex-row flex-col w-full">
            <default-input class="mt-2 md:w-1/3 w-full" label="{{ __('app.user_fname') }}" placeholder="{{ __('app.user_fname') }}" value="{{ $user->fname }}" name="fname"></default-input>
            <default-input class="mt-2 md:px-4 px-0 md:w-1/3 w-full" label="{{ __('app.user_lname') }}" placeholder="{{ __('app.user_lname') }}" value="{{ $user->lname }}" name="lname"></default-input>
            <default-input class="mt-2 md:w-1/3 w-full" label="{{ __('app.username') }}" placeholder="{{ __('app.username') }}" value="{{ $user->username }}" name="username"></default-input>
        </div>
        <div class="flex md:flex-row flex-col w-full">
            <default-input class="mt-2 md:pr-2 pr-0 md:w-1/2 w-full" type="password" label="{{ __('app.user_password') }}" placeholder="{{ __('app.user_password') }}" name="password"></default-input>
            <default-input class="mt-2 md:pl-2 pl-0 md:w-1/2 w-full" type="password" label="{{ __('app.user_password_repeat') }}" placeholder="{{ __('app.user_password_repeat') }}" name="password-repeat"></default-input>
        </div>
        <div class="w-full pt-6">
            <button type="submit" class="w-full bg-teal-500 hover:bg-teal-800 text-white uppercase tracking-widest text-center rounded h-10 duration-300 ease-out">
                {{ __('app.misc_update') }}
            </button>
        </div>
    </form>
@endsection
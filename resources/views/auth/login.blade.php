@extends('layouts.auth')

@section('title', __('app.login'))

@section('content')
    <div class="w-full flex flex-col">
        <form class="form-horizontal" method="POST" action="/login">
            @csrf

            @if (session('info'))
                <div class="w-full mb-3">
                    <div class="bg-teal-200 text-teal-800 rounded w-full text-center border border-teal-400 p-2" role="alert">
                        {{ session('info') }}
                    </div>
                </div>
            @endif

            @if(!$errors->isEmpty())
                @foreach($errors->all() as $error)
                    <div class="w-full mb-3">
                        <div class="bg-red-200 text-red-800 rounded w-full text-center border border-red-400 p-2" role="alert">
                            {{ $error }}
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="bg-transparent overflow-hidden focus-within:border-teal-500 relative">
                <input type="text" name="username" placeholder="{{ __('app.username') }}"
                    class="w-full relative text-lg h-12 px-4 rounded-t border border-grey z-0 focus:z-10 focus:border-teal-500 focus:outline-none appearance-none" 
                    value="{{ old('username') }}" required autofocus>

                <input type="password" name="password"
                    placeholder="•••••••••" 
                    class="w-full relative text-lg h-12 px-4 rounded-b border border-grey-100 z-0 focus:z-10 focus:border-teal-500 focus:outline-none appearance-none" style="margin-top: -1px;" required>
            </div>

            <div class="form-group">
                    <label class="inline-flex items-center mt-2 mb-6">
                        <input type="checkbox" class="form-radio text-teal-500" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="ml-2" for="remember">{{ __('app.login_keep_logged_in') }}</span>
                    </label>
            </div>

            <div class="w-full">
                <button type="submit" class="w-full bg-teal-500 hover:bg-teal-800 text-white uppercase tracking-widest text-center rounded h-10 duration-300 ease-out">
                    {{ __('app.login_action') }}
                </button>
            </div>
        </form>
        <span class="text-xs text-gray-500 text-center">{{ config('expensemanager.version') }}</span>
    </div>
@endsection
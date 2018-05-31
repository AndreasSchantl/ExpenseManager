@extends('layouts.app')

@section('title', __('app.type_create'))

@section('content')
    <h1>{{ __('app.type_create') }}</h1>

    <form action="/expensetypes" method="post">
        @csrf
        <div class="form-row mt-3">
            <div class="col-md-6">
                <input title="{{ __('app.type_name') }}" type="text" name="name" placeholder="{{ __('app.type_name') }}" class="form-control">
                <small>{{ __('app.type_name') }}</small>
            </div>
            <div class="col-md-6">
                <select title="{{ __('app.type_no_parent') }}" name="parent" class="form-control">
                    <option value="-1">{{ __('app.type_no_parent') }}</option>
                    @foreach(\App\ExpenseType::all() as $t)
                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                    @endforeach
                </select>
                <small>{{ __('app.type_parent') }}</small>
            </div>
        </div>
        <div class="form-row mt-3">
            <button class="btn btn-primary font-weight-bold text-white">{{ __('app.misc_create') }}</button>
        </div>
    </form>
@endsection
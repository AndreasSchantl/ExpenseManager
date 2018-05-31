@extends('layouts.app')

@section('title', __('app.type_update'))

@section('content')
    <h1>{{ __('app.type_update') }}</h1>

    <form action="/expensetypes/{{ $type->id }}" method="post">
        @method('put')
        @csrf
        <div class="form-row mt-3">
            <div class="col-md-6">
                <input title="{{ __('app.type_name') }}" type="text" name="name" placeholder="{{ __('app.type_name') }}" value="{{ $type->name }}" class="form-control">
                <small>{{ __('app.type_name') }}</small>
            </div>
            <div class="col-md-6">
                <select title="{{ __('app.type_no_parent') }}" name="parent" class="form-control">
                    <option value="-1">{{ __('app.type_no_parent') }}</option>
                    @foreach(\App\ExpenseType::all() as $t)
                        @if($t->id != $type->id)
                            <option value="{{ $t->id }}" @if($t->id == $type->parent) selected @endif>{{ $t->name }}</option>
                        @endif
                    @endforeach
                </select>
                <small>{{ __('app.type_parent') }}</small>
            </div>
        </div>
        <div class="form-row mt-3">
            <button class="btn btn-primary font-weight-bold text-white">{{ __('app.misc_update') }}</button>
        </div>
    </form>
@endsection
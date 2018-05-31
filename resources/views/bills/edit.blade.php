@extends('layouts.app')

@section('title', __('app.exp_edit'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ __('app.exp_edit') }}</h1>
            <form action="/expenses/{{ $bill->id }}" method="post">
                @method('put')
                @csrf
                <div class="form-row p-1">
                    <textarea title="{{ __('app.exp_description') }}" name="description" placeholder="{{ __('app.exp_description') }}" class="form-control">{{ $bill->description }}</textarea>
                </div>
                <div class="form-row p-1">
                    <input title="{{ __('app.exp_date') }}" type="date" name="date" value="{{ $bill->date->format('Y-m-d') }}" class="form-control">
                    <small>{{ __('app.exp_date') }}</small>
                </div>
                <div class="form-row p-1">
                    <input title="{{ __('app.exp_amount') }}" type="number" name="amount" step="0.01" value="{{ $bill->amount }}"
                           placeholder="{{ __('app.exp_amount') }}"
                           class="form-control">
                    <small>{{ __('app.exp_amount') }}</small>
                </div>
                <div class="form-row p-1">
                    <select title="{{ __('app.exp_type') }}" name="type" class="form-control">
                        @foreach(App\ExpenseType::all() as $type)
                            <option value="{{ $type->id }}" @if($bill->type == $type->id) selected @endif>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                    <small>{{ __('app.exp_type') }}</small>
                </div>
                <div class="form-row p-1">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="guarantee" id="guarantee"
                               @if($bill->guarantee) checked @endif>
                        <label class="custom-control-label" for="guarantee">{{ __('app.exp_guarantee') }}</label>
                    </div>
                </div>
                <div class="form-row">
                    <button class="btn btn-primary font-weight-bold text-white">{{ __('app.misc_update') }}</button>
                </div>
            </form>
        </div>
@endsection
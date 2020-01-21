@extends('layouts.app')

@section('title', __('app.exp_edit'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold">{{ __('app.exp_edit') }}</h1>
            <form action="/expenses/{{ $bill->id }}" method="post">
                @method('put')
                @csrf
                <default-textfield label="Beschreibung" placeholder="Beschreibung" name="description" :max="70" value="{{ $bill->description }}"></default-textfield>
                <default-input class="mt-2" label="{{ __('app.exp_date') }}" placeholder="{{ __('app.exp_date') }}" type="date" name="date" value="{{ $bill->date->format('Y-m-d') }}"></default-input>
                <default-input class="mt-2" label="{{ __('app.exp_amount') }} - {{ env('CURRENCY') }}" placeholder="{{ __('app.exp_amount') }}" type="number" name="amount" step="0.01" value="{{ $bill->amount }}"></default-input>
                <div class="flex flex-col mt-2">
                    <span class="text-sm">{{ __('app.exp_type') }}</span>
                    <select class="h-10 bg-white w-full border border-grey-100 px-4 focus:border-teal-500 focus:border-l focus:border-r focus:outline-none rounded appearance-none"
                        title="{{ __('app.exp_type') }}" name="type" class="form-control">
                        @foreach(App\ExpenseType::all() as $type)
                            <option value="{{ $type->id }}" {{ $bill->type == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="inline-flex items-center mt-2 mb-6">
                        <input type="checkbox" class="form-radio text-teal-500" id="guarantee" name="guarantee" value="1" {{ $bill->guarantee ? 'checked' : '' }}>
                        <span class="ml-2" for="guarantee">{{ __('app.exp_guarantee') }}</span>
                    </label>
                </div>
                <div class="w-full">
                    <button type="submit" class="w-full bg-teal-500 hover:bg-teal-800 text-white uppercase tracking-widest text-center rounded h-10 duration-300 ease-out">
                        {{ __('app.misc_update') }}
                    </button>
                </div>
            </form>
        </div>
@endsection
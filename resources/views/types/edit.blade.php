@extends('layouts.app')

@section('title', __('app.type_update'))

@section('content')
    <h1 class="font-bold text-2xl mx-4 md:mx-0">{{ __('app.type_update') }}</h1>

    <form action="/expensetypes/{{ $type->id }}" method="post" class="mx-4 md:mx-0">
        @method('put')
        @csrf
        <default-input class="mt-2" label="{{ __('app.type_name') }}" placeholder="{{ __('app.type_name') }}" name="name" value="{{ $type->name }}"></default-input>
        <div class="flex flex-col mt-2">
            <span class="text-sm">{{ __('app.type_parent') }}</span>
            <select class="h-10 bg-white w-full border border-grey-100 px-4 focus:border-teal-500 focus:border-l focus:border-r focus:outline-none rounded appearance-none"
                title="{{ __('app.type_parent') }}" name="parent" class="form-control">
                <option value="-1">{{ __('app.type_no_parent') }}</option>
                @foreach(\App\ExpenseType::all() as $t)
                    <option value="{{ $t->id }}" @if($t->id == $type->parent) selected @endif>{{ $t->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full pt-6">
            <button type="submit" class="w-full bg-teal-500 hover:bg-teal-800 text-white uppercase tracking-widest text-center rounded h-10 duration-300 ease-out">
                {{ __('app.misc_update') }}
            </button>
        </div>
    </form>
@endsection
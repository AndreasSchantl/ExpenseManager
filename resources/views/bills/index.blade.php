@extends('layouts.app')

@section('title', __('app.expenses'))

@section('middle_menu')
<div class="flex items-center w-full md:ml-4 md:mr-24 bg-white h-10 rounded">
    <form class="flex h-full flex-grow" action="{{ url('/expenses') }}">
        <input
            class="w-full inline-block h-full border border-r-0 rounded-l border-grey-100 px-4 focus:border-teal-500 focus:border-r focus:outline-none"
            name="search" value="{{ request('search') }}" placeholder="{{ __('app.exp_search') }}" type="text">
        <select
            class="h-full bg-white md:w-16 w-12 border border-l-0 border-r-0 border-grey-100 md:px-4 px-2 focus:border-teal-500 focus:border-l focus:border-r focus:outline-none rounded-none appearance-none"
            name="month" placeholder="MM">
            <option value="1" {{ $month == 1 ? 'selected' : '' }}>{{ __('app.month_january') }}.</option>
            <option value="2" {{ $month == 2 ? 'selected' : '' }}>{{ __('app.month_february') }}.</option>
            <option value="3" {{ $month == 3 ? 'selected' : '' }}>{{ __('app.month_march') }}.</option>
            <option value="4" {{ $month == 4 ? 'selected' : '' }}>{{ __('app.month_april') }}.</option>
            <option value="5" {{ $month == 5 ? 'selected' : '' }}>{{ __('app.month_may') }}.</option>
            <option value="6" {{ $month == 6 ? 'selected' : '' }}>{{ __('app.month_june') }}.</option>
            <option value="7" {{ $month == 7 ? 'selected' : '' }}>{{ __('app.month_july') }}.</option>
            <option value="8" {{ $month == 8 ? 'selected' : '' }}>{{ __('app.month_august') }}.</option>
            <option value="9" {{ $month == 9 ? 'selected' : '' }}>{{ __('app.month_september') }}.</option>
            <option value="10" {{ $month == 10 ? 'selected' : '' }}>{{ __('app.month_october') }}.</option>
            <option value="11" {{ $month == 11 ? 'selected' : '' }}>{{ __('app.month_november') }}.</option>
            <option value="12" {{ $month == 12 ? 'selected' : '' }}>{{ __('app.month_december') }}.</option>
            <option value="0" {{ $month == 0 ? 'selected' : '' }}>{{ __('app.months_all') }}</option>
        </select>
        <input
            class="h-full md:w-24 w-20 border border-l-0 border-r-0 border-grey-100 px-4 focus:border-teal-500 focus:border-l focus:border-r focus:outline-none"
            type="number" name="year" placeholder="YYYY" value="{{ $year }}">
        <button class="pr-4 pl-2 border border-l-0 border-grey-100 rounded-r focus:outline-none focus:border-l focus:border-teal-500 hover:border-teal-500" type="submit" title="{{ __('app.misc_show') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 icon-search">
                <circle cx="10" cy="10" r="7" class="primary"></circle>
                <path class="secondary" d="M16.32 14.9l1.1 1.1c.4-.02.83.13 1.14.44l3 3a1.5 1.5 0 0 1-2.12 2.12l-3-3a1.5 1.5 0 0 1-.44-1.14l-1.1-1.1a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"></path>
            </svg>
        </button>
    </form>
</div>
@endsection

@section('content')
<div class="flex md:flex-row flex-col">
    <div class="flex flex-col md:w-1/4 w-full md:pl-0 pl-4 pr-4">
        <h3 class="font-bold text-2xl">{{ __('app.exp_overview') }}</h3>
        <table class="table-auto w-full">
            <thead class="bg-gray-800 rounded-t text-white">
                <tr>
                    <th class="text-left p-1">{{ __('app.exp_type_short') }}</th>
                    <th class="text-right p-1">{{ __('app.exp_amount') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach(App\ExpenseType::all() as $type)
                <tr class="hover:bg-gray-200">
                    <td class="p-1">{{ $type->name }}</td>
                    <td class="p-1 text-right">
                        <nobr>
                            {{ number_format($type->total($month, $year), 2, env('DECIMAL_PNT'), env('THOUSAND_SEP')) }}
                            {{ env('CURRENCY') }}</nobr>
                    </td>
                </tr>
                @endforeach
                <tr class="font-bold bg-gray-300">
                    <td class="p-1">{{ __('app.exp_total') }}</td>
                    <td class="p-1 text-right">
                        <nobr>{{ number_format($total, 2, env('DECIMAL_PNT'), env('THOUSAND_SEP')) }}
                            {{ env('CURRENCY') }}</nobr>
                    </td>
                </tr>
            </tbody>
        </table>

        <hr>

        <h4 class="font-bold text-2xl mt-6">{{ __('app.exp_new') }}</h4>
        <form action="{{ url('expenses') }}" method="post">
            @csrf
            <default-textfield label="Beschreibung" placeholder="Beschreibung" name="description" :max="70" :autofocus="true"></default-textfield>
            <default-input class="mt-2" label="{{ __('app.exp_date') }}" placeholder="{{ __('app.exp_date') }}" type="date" name="date" value="{{ old('date') }}"></default-input>
            <default-input class="mt-2" label="{{ __('app.exp_amount') }} - {{ env('CURRENCY') }}" placeholder="{{ __('app.exp_amount') }}" type="number" name="amount" step="0.01" value="{{ old('amount') }}"></default-input>
            <div class="flex flex-col mt-2">
                <span class="text-sm">{{ __('app.exp_type') }}</span>
                <select class="h-10 bg-white w-full border border-grey-100 px-4 focus:border-teal-500 focus:border-l focus:border-r focus:outline-none rounded appearance-none"
                    title="{{ __('app.exp_type') }}" name="type" class="form-control">
                    @foreach(App\ExpenseType::all() as $type)
                        <option value="{{ $type->id }}" {{ old('type') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="inline-flex items-center mt-2 mb-6">
                    <input type="checkbox" class="form-radio text-teal-500" id="guarantee" name="guarantee" value="1" {{ old('guarantee') ? 'checked' : '' }}>
                    <span class="ml-2" for="guarantee">{{ __('app.exp_guarantee') }}</span>
                </label>
            </div>
            <div class="w-full pb-12">
                <button type="submit" class="w-full bg-teal-500 hover:bg-teal-800 text-white uppercase tracking-widest text-center rounded h-10 duration-300 ease-out">
                    {{ __('app.misc_add') }}
                </button>
            </div>
        </form>
    </div>


    <div class="flex flex-col md:w-3/4 w-full pl-4 md:pr-0 pr-4 md:pt-0 pt-">
        <h3 class="font-bold text-2xl">{{ __('app.expenses') }}</h3>
        <table class="table-fixed table-stacked w-full">
            <thead class="bg-gray-800 rounded-t text-white">
                <tr>
                    <th class="text-left p-1 w-1/3">{{ __('app.exp_description') }}</th>
                    <th class="text-left p-1">{{ __('app.exp_date') }}</th>
                    <th class="text-left p-1">{{ __('app.exp_type_short') }}</th>
                    <th class="text-right p-1">{{ __('app.exp_amount') }}</th>
                    <th class="text-center p-1">{{ __('app.exp_guarantee') }}</th>
                    <th class="text-center p-1 w-10"></th>
                    <th class="text-center p-1 w-10"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($bills as $bill)
                <tr class="hover:bg-gray-200">
                    <td data-label="{{ __('app.exp_description') }}" class="text-left p-1">{{ $bill->description }}</td>
                    <td data-label="{{ __('app.exp_date') }}" class="text-left p-1">{{ $bill->date->format(env('DATE_FORMAT')) }}</td>
                    <td data-label="{{ __('app.exp_type_short') }}" class="text-left p-1">{{ $bill->typeO->name }}</td>
                    <td data-label="{{ __('app.exp_amount') }}" class="text-right p-1">
                        <nobr>{{ number_format($bill->amount, 2, env('DECIMAL_PNT'), env('THOUSAND_SEP')) }}
                            {{ env('CURRENCY') }}</nobr>
                    </td>
                    <td data-label="{{ __('app.exp_guarantee') }}" class="text-center p-1">
                        <div class="form-group mt-1">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="{{ $bill->id }}" class="form-radio text-teal-500" {{ $bill->guarantee ? 'checked' : '' }} disabled>
                            </label>
                        </div>
                    </td>
                    <td data-label="{{ __('app.misc_update') }}">
                        <button onclick="location.href='{{ route('expenses.edit', $bill->id) }}'" title="{{ __('app.users') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 icon-edit">
                                <path class="primary" d="M4 14a1 1 0 0 1 .3-.7l11-11a1 1 0 0 1 1.4 0l3 3a1 1 0 0 1 0 1.4l-11 11a1 1 0 0 1-.7.3H5a1 1 0 0 1-1-1v-3z"></path>
                                <rect width="20" height="2" x="2" y="20" class="secondary" rx="1"></rect>
                            </svg>
                        </button>
                    </td>
                    <td data-label="{{ __('app.misc_delete') }}">
                        <delete-button route="{{ route('expenses.destroy', $bill->id) }}"></delete-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
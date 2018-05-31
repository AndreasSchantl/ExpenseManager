@extends('layouts.app')

@section('title', __('app.expenses'))

@section('left_sidebar')
    {{-- Left Side Of Navbar --}}
    <div class="navbar-nav mr-auto">
        <form action="{{ url('/expenses') }}">
            <div class="form-row">
                <div class="col-sm-3 pt-1">
                    <input type="number" name="month" class="form-control" placeholder="MM" value="{{ $month }}">
                </div>
                <div class="col-sm-3 pt-1">
                    <input type="number" name="year" class="form-control" placeholder="YYYY" value="{{ $year }}">
                </div>
                <div class="col-sm-3 pt-1">
                    <button class="btn btn-secondary" type="submit">{{ __('app.misc_show') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <h3>{{ __('app.exp_overview') }}</h3>
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('app.exp_type_short') }}</th>
                    <th>{{ __('app.exp_amount') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach(App\ExpenseType::all() as $type)
                    <tr>
                        <td>{{ $type->name }}</td>
                        <td class="text-right">
                            <nobr>{{ number_format($type->total($month, $year), 2, env('DECIMAL_PNT'), env('THOUSAND_SEP')) }} {{ env('CURRENCY') }}</nobr>
                        </td>
                    </tr>
                @endforeach
                <tr class="bg-light font-weight-bold">
                    <td>{{ __('app.exp_total') }}</td>
                    <td>
                        <nobr>{{ number_format($total, 2, env('DECIMAL_PNT'), env('THOUSAND_SEP')) }} {{ env('CURRENCY') }}</nobr>
                    </td>
                </tr>
                </tbody>
            </table>

            <hr>

            <h4>{{ __('app.exp_new') }}</h4>
            <form action="{{ url('expenses') }}" method="post">
                @csrf
                <div class="form-row p-1">
                    <textarea title="{{ __('app.exp_description') }}" name="description" placeholder="{{ __('app.exp_description') }}" class="form-control"
                              v-model="desc" v-on:keyup="trim" v-focus>
                    </textarea>
                    <small>{{ __('app.exp_description') }} |
                        <description-counter v-bind:desc="desc"></description-counter> {{ __('app.exp_char_count_remaining') }}
                    </small>
                </div>
                <div class="form-row p-1">
                    <input title="{{ __('app.exp_date') }}" type="date" name="date" value="{{ old('date') }}" class="form-control">
                    <small>{{ __('app.exp_date') }}</small>
                </div>
                <div class="form-row p-1">
                    <input title="{{ __('app.exp_amount') }}" type="number" name="amount" step="0.01" value="{{ old('amount') }}"
                           placeholder="{{ __('app.exp_amount') }}"
                           class="form-control">
                    <small>{{ __('app.exp_amount') }}</small>
                </div>
                <div class="form-row p-1">
                    <select title="{{ __('app.exp_type') }}" name="type" class="form-control">
                        @foreach(App\ExpenseType::all() as $type)
                            <option value="{{ $type->id }}" @if(old('type') == $type->id) selected @endif>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                    <small>{{ __('app.exp_type') }}</small>
                </div>
                <div class="form-row p-1">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="guarantee" id="guarantee"
                               @if(old('guarantee')) checked @endif>
                        <label class="custom-control-label" for="guarantee">{{ __('app.exp_guarantee') }}</label>
                    </div>
                </div>
                <div class="form-row">
                    <button class="btn btn-primary btn-block font-weight-bold text-white">{{ __('app.misc_add') }}</button>
                </div>
            </form>
        </div>


        <div class="col-md-9">
            <h3>{{ __('app.expenses') }}</h3>
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('app.exp_description') }}</th>
                    <th>{{ __('app.exp_date') }}</th>
                    <th>{{ __('app.exp_type_short') }}</th>
                    <th>{{ __('app.exp_amount') }}</th>
                    <th>{{ __('app.exp_guarantee') }}</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($bills as $bill)
                    <tr>
                        <td>{{ $bill->description }}</td>
                        <td>{{ $bill->date->format(env('DATE_FORMAT')) }}</td>
                        <td>{{ $bill->typeO->name }}</td>
                        <td class="text-right">
                            <nobr>{{ number_format($bill->amount, 2, env('DECIMAL_PNT'), env('THOUSAND_SEP')) }} {{ env('CURRENCY') }}</nobr>
                        </td>
                        <td class="d-flex justify-content-center">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="guarantee-table" disabled
                                       @if($bill->guarantee) checked @endif>
                                <label class="custom-control-label" for="guarantee-table"></label>
                            </div>
                        </td>
                        <td>
                            <button onclick="location.href='/expenses/{{ $bill->id }}/edit'"
                                    class="btn btn-secondary btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-secondary btn-sm"
                                    data-toggle="modal"
                                    data-target="#delete"
                                    data-action="/expenses/{{ $bill->id }}"
                                    data-name="{{ $bill->date->format(env('DATE_FORMAT')) }} ({{ $bill->description }})">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="delete" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('app.exp_delete') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="remove-form" method="POST">
                        @method('delete')
                        @csrf
                        <p>
                            {!! __('app.exp_deletion_text', ['exp' => '<span style="font-weight: 700;" id="del-name"></span>']) !!}
                        </p>
                        <div>
                            <button type="submit" class="btn btn-primary font-weight-bold text-white mt-3">
                                {{ __('app.misc_delete') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
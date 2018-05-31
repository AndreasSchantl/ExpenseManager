@extends('layouts.app')

@section('title', __('app.types'))

@section('content')
    <h1>
        {{ __('app.types') }}
        <a href="{{ url()->to('expensetypes/create') }}" class="btn btn-primary font-weight-bold text-white">{{ __('app.misc_create') }}</a>
    </h1>

    <div class="table-responsive">
        <table class="table table-hover" id="user-table">
            <thead class="thead-dark">
            <tr>
                <th>{{ __('app.type_name') }}</th>
                <th>{{ __('app.type_parent_short') }}</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($types as $type)
                <tr>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->parent != null ? $type->parentO->name : '' }}</td>
                    <td>
                        <button
                                class="btn btn-secondary btn-sm btn-icon"
                                onclick="location.href='{{ url()->to('expensetypes/'. $type->id) .'/edit' }}'"
                        >
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                    <td>
                        <button
                                class="btn btn-secondary btn-sm btn-icon"
                                data-toggle="modal"
                                data-target="#delete"
                                data-action="/expensetypes/{{ $type->id }}"
                                data-name="{{ $type->name }}"
                        >
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div id="delete" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('app.type_delete') }}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="remove-form" method="POST">
                            @method('delete')
                            @csrf
                            <p>
                                {!! __('app.type_deletion_text', ['type' => '<span style="font-weight: 700;" id="del-name"></span>']) !!}
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
    </div>
@endsection
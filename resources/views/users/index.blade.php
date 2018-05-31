@extends('layouts.app')

@section('title', __('app.users'))

@section('content')
    <h1>
        {{ __('app.users') }}
        <a href="{{ url()->to('users/create') }}" class="btn btn-primary font-weight-bold text-white">{{ __('app.misc_create') }}</a>
    </h1>

    <div class="table-responsive">
        <table class="table table-hover" id="user-table">
            <thead class="thead-dark">
            <tr>
                <th>{{ __('app.user_fname') }}</th>
                <th>{{ __('app.user_lname') }}</th>
                <th>{{ __('app.username') }}</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->fname }}</td>
                    <td>{{ $user->lname }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        <button
                                class="btn btn-secondary btn-sm"
                                onclick="location.href='{{ url()->to('users/'. $user->id) .'/edit' }}'"
                        >
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                    <td>
                        <button
                                class="btn btn-secondary btn-sm"
                                data-toggle="modal"
                                data-target="#delete"
                                data-action="/users/{{ $user->id }}"
                                data-name="{{ $user->fname }} {{ $user->lname }}"
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
                        <h4 class="modal-title">{{ __('app.user_delete') }}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="remove-form" method="POST">
                            @method('delete')
                            @csrf
                            <p>
                                {!! __('app.user_deletion_text', ['user' => '<span style="font-weight: 700;" id="del-name"></span>']) !!}
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
@extends('layouts.app')

@section('title', __('app.users'))

@section('content')
    <div class="flex justify-between pb-2 md:mx-0 mx-4">
        <h1 class="font-bold text-2xl">{{ __('app.users') }}</h1>
        <a href="{{ route('users.create') }}" class="flex items-center px-2 bg-teal-500 hover:bg-teal-800 text-white uppercase tracking-widest text-center rounded duration-300 ease-out">{{ __('app.misc_create') }}</a>
    </div>
    <table class="table-fixed table-stacked w-full md:mx-0 mx-4">
        <thead class="bg-gray-800 rounded-t text-white">
            <tr>
                <th class="text-left p-1 w-1/3">{{ __('app.user_fname') }}</th>
                <th class="text-left p-1">{{ __('app.user_lname') }}</th>
                <th class="text-left p-1">{{ __('app.username') }}</th>
                <th class="text-center p-1 w-10"></th>
                <th class="text-center p-1 w-10"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="hover:bg-gray-200">
                <td data-label="{{ __('app.user_fname') }}" class="text-left p-1">{{ $user->fname }}</td>
                <td data-label="{{ __('app.user_lname') }}" class="text-left p-1">{{ $user->lname }}</td>
                <td data-label="{{ __('app.username') }}" class="text-left p-1">{{ $user->username }}</td>
                <td data-label="{{ __('app.misc_update') }}">
                    <button onclick="location.href='{{ route('users.edit', $user->id) }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 icon-edit">
                            <path class="primary" d="M4 14a1 1 0 0 1 .3-.7l11-11a1 1 0 0 1 1.4 0l3 3a1 1 0 0 1 0 1.4l-11 11a1 1 0 0 1-.7.3H5a1 1 0 0 1-1-1v-3z"></path>
                            <rect width="20" height="2" x="2" y="20" class="secondary" rx="1"></rect>
                        </svg>
                    </button>
                </td>
                <td data-label="{{ __('app.misc_delete') }}">
                    <delete-button route="{{ route('users.destroy', $user->id) }}"></delete-button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
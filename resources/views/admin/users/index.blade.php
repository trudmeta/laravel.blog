@extends('admin.layouts.app')

@section('content')
    <div class="page-header d-flex justify-content-between">
        <h1>@lang('Users')</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm align-self-center">
            <i class="fa fa-plus-square" aria-hidden="true"></i> @lang('Add')
        </a>
    </div>

    <table class="table table-striped table-sm table-responsive-md">
        <thead>
        <tr>
            <th>@lang('Title')</th>
            <th>@lang('Registered')</th>
            <th>@lang('Role')</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ link_to_route('admin.users.edit', $user->login, $user) }}</td>
                <td>{{ $user->updated_at }}</td>
                <td>{{ $user->roles->implode('name', ',') }}</td>
                <td class="text-right">
                    @can('update', $user)
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm" title="{{ __("Edit") }}">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                    @endcan
                    @can('delete', $user)
                    {!! Form::model($user, ['method' => 'DELETE', 'route' => ['admin.users.destroy', $user], 'class' => 'form-inline btn', 'data-confirm' => __('forms.posts.delete')]) !!}
                    {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-sm', 'name' => 'submit', 'type' => 'submit', 'title' => __('Delete')]) !!}
                    {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>

@endsection

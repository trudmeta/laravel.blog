@extends('admin.layouts.app')

@section('content')
    <h3>@lang('Edit')</h3>

    {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' =>'PUT']) !!}
        @include('admin/users/_form')

        <div class="float-left">
            {!! Form::submit(__('Update'), ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

    @can('delete', $user)
    {!! Form::model($user, ['method' => 'DELETE', 'route' => ['admin.users.destroy', $user], 'class' => 'form-inline float-right', 'data-confirm' => __('Delete')]) !!}
        {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ' . __('Delete'), ['class' => 'btn btn-link text-danger', 'name' => 'submit', 'type' => 'submit']) !!}
    {!! Form::close() !!}
    @endcan
@endsection

@extends('admin.layouts.app')

@section('content')
    <h1>@lang('Create')</h1>

    {!! Form::open(['route' => ['admin.users.store'], 'method' =>'POST']) !!}
        @include('admin/users/_form')

        {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection

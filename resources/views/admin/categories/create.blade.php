@extends('admin.layouts.app')

@section('content')
    <h1>@lang('Create')</h1>

    {!! Form::open(['route' => ['admin.categories.store'], 'method' =>'POST']) !!}
        @include('admin/categories/_form')

        {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection

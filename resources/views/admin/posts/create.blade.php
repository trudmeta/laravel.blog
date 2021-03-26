@extends('admin.layouts.app')

@section('content')
    <h1>@lang('Create')</h1>

    {!! Form::open(['route' => ['admin.posts.store'], 'method' =>'POST', 'enctype' => 'multipart/form-data']) !!}
        @include('admin/posts/_form')

        {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection

@extends('admin.layouts.app')

@section('content')
    <h3>@lang('Edit')</h3>

    {!! Form::model($post, ['route' => ['admin.posts.update', $post], 'method' =>'PUT', 'enctype' => 'multipart/form-data']) !!}
        @include('admin/posts/_form')

        <div class="float-left">
            {!! Form::submit(__('Update'), ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

    {!! Form::model($post, ['method' => 'DELETE', 'route' => ['admin.posts.destroy', $post], 'class' => 'form-inline float-right', 'data-confirm' => __('Delete')]) !!}
        {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ' . __('Delete'), ['class' => 'btn btn-link text-danger', 'name' => 'submit', 'type' => 'submit']) !!}
    {!! Form::close() !!}
@endsection

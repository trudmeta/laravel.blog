@extends('admin.layouts.app')

@section('content')
    <div class="page-header d-flex justify-content-between">
        <h3>@lang('Edit')</h3>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm align-self-center">
            <i class="fa fa-plus-square" aria-hidden="true"></i> @lang('Add')
        </a>
    </div>

    {!! Form::model($category, ['route' => ['admin.categories.update', $category], 'method' =>'PUT']) !!}
        @include('admin/categories/_form')

        <div class="float-left">
            {!! Form::submit(__('Update'), ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

    {!! Form::model($category, ['method' => 'DELETE', 'route' => ['admin.categories.destroy', $category], 'class' => 'form-inline float-right', 'data-confirm' => __('Delete')]) !!}
        {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ' . __('Delete'), ['class' => 'btn btn-link text-danger', 'name' => 'submit', 'type' => 'submit']) !!}
    {!! Form::close() !!}
@endsection

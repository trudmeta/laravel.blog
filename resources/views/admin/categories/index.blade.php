@extends('admin.layouts.app')

@section('content')
    <div class="page-header d-flex justify-content-between">
        <h1>@lang('Categories')</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm align-self-center">
            <i class="fa fa-plus-square" aria-hidden="true"></i> @lang('Add')
        </a>
    </div>

    <table class="table table-striped table-sm table-responsive-md">
        <thead>
        <tr>
            <th>@lang('Title')</th>
            <th>@lang('Posted at')</th>
            <th>@lang('Position')</th>
            <th>@lang('Published')</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ link_to_route('admin.categories.edit', $category->title, $category) }}</td>
                <td>{{ $category->updated_at }}</td>
                <td>{{ $category->position }}</td>
                <td>
                    @if($category->status)
                        <i class="fa fa-battery-full" aria-hidden="true"></i>
                    @else
                        <i class="fa fa-battery-empty" aria-hidden="true"></i>
                    @endif
                </td>
                <td class="text-right">
                    @can('delete', $category)
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                    {!! Form::model($category, ['method' => 'DELETE', 'route' => ['admin.categories.destroy', $category], 'class' => 'form-inline btn', 'data-confirm' => __('Delete')]) !!}
                    {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-sm', 'name' => 'submit', 'type' => 'submit']) !!}
                    {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $categories->links() }}
    </div>

@endsection

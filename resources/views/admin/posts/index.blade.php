@extends('admin.layouts.app')

@section('content')
    <div class="page-header d-flex justify-content-between">
        <h1>@lang('Posts')</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm align-self-center">
            <i class="fa fa-plus-square" aria-hidden="true"></i> @lang('Add')
        </a>
    </div>

    <table class="table table-striped table-sm table-responsive-md">
        <thead>
        <tr>
            <th>@lang('Title')</th>
            <th>@lang('Author')</th>
            <th>@lang('Posted at')</th>
            <th>@lang('Published')</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{ link_to_route('admin.posts.edit', $post->title, $post) }}</td>
                <td>{{ link_to_route('admin.users.edit', $post->author->login, $post->author) }}</td>
                <td>{{ $post->updated_at }}</td>
                <td>
                    @if($post->status)
                        <i class="fa fa-battery-full" aria-hidden="true"></i>
                    @else
                        <i class="fa fa-battery-empty" aria-hidden="true"></i>
                    @endif
                </td>
                <td class="text-right">
                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary btn-sm" title="{{ __("Edit") }}">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                    @can('delete', $post)
                    {!! Form::model($post, ['method' => 'DELETE', 'route' => ['admin.posts.destroy', $post], 'class' => 'form-inline btn', 'data-confirm' => __('forms.posts.delete')]) !!}
                    {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-sm', 'name' => 'submit', 'type' => 'submit', 'title' => __('Delete')]) !!}
                    {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>

@endsection

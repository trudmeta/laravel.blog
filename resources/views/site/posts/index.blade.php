@extends('site.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>{{ __('Blog') }}</h1>
        </div>
        <table class="table table-striped table-sm table-responsive-md">
            <thead>
            <tr>
                <th>@lang('Title')</th>
                <th>@lang('Author')</th>
                <th>@lang('Posted at')</th>
                <th>@lang('Published')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td><a href="/post/{{ $post->slug }}">{{ $post->title }}</a></td>
                    <td>{{ $post->author->login }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>
                        @if($post->status)
                            <i class="fa fa-battery-full" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-battery-empty" aria-hidden="true"></i>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop

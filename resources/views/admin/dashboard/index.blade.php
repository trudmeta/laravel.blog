@extends('admin.layouts.app')

@section('content')
    <div>
        <h1>@lang('Dashboard')</h1>
        <p>@lang('Posts count: ') {{ $posts }}</p>
        <p>@lang('Categories count: ') {{ $categories }}</p>
    </div>
@endsection

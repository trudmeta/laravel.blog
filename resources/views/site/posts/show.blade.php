@extends('site.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>{{ $post->title }}</h3>
                @if(!empty($post->image))
                    <div class="form-group">
                        <img src="{{ $post->image->url }}" alt="">
                    </div>
                @endif
                <div>
                    {{ $post->content }}
                </div>
            </div>
        </div>
    </div>
@endsection

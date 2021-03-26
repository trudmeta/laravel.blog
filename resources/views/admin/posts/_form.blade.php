{!! Form::hidden('author_id', Auth::id()) !!}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    {!! Form::label('title', __('Title')) !!}
    {!! Form::text('title', null, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'required']) !!}

    @error('title')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
@if(!empty($post))
<div class="form-group">
    {!! Form::label('slug', __('Slug')) !!}
    <p class="form-control">{{ $post->slug }}</p>
</div>
@endif

<div class="form-group">
    {!! Form::hidden('thumbnail_name', isset($thumbnail)? $thumbnail->name : '', ['class' => 'thumbnail_name']) !!}
    <div class="col-2 mb-3 main-image-wrapper">
        <label for="thumbnail_id" class="label-main-image">
            @isset($thumbnail)
            <img src="{{ $thumbnail->url }}" class="js-main-image" alt="">
            @endisset
        </label>
        {!! Form::label('thumbnail_id', __('Thumbnail')) !!}<br>
        {!! Form::file('thumbnail_id') !!}
    </div>
    @if($images->count())
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#image_modal">
        {{ __('Media') }}
    </button>
    @endif

    @error('thumbnail_id')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group align-items-center">
    {!! Form::label('categories', __('Categories')) !!}
    @if(!$categories->isEmpty())
    <select name="categories[]" class="form-control" multiple>
        @include('admin.posts._categories')
    </select>
    @else
        {{ __('No categories') }}
    @endif
</div>

<div class="form-group">
    {!! Form::label('content', __('Content')) !!}
    {!! Form::textarea('content', null, ['class' => 'form-control trumbowyg-form' . ($errors->has('content') ? ' is-invalid' : ''), 'required']) !!}

    @error('content')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('status', __('Published'), ['class' => 'mr-2 align-middle']) !!}
    {!! Form::checkbox("status", null) !!}
</div>

@if(!empty($images))
<!-- Modal -->
<div class="modal fade" id="image_modal" tabindex="-1" role="dialog" aria-labelledby="image_modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Chose image') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                @foreach($images as $image)
                <div class="col-md-4 mb-2">
                    <img src="{{ $image->url }}" data-dismiss="modal" aria-label="Close" class="js-modal-image modal-image-{{$loop->iteration}}" alt="{{ $image->name }}" data-id="{{ $image->id }}">
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif

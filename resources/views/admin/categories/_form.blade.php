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
<div class="form-group">
    {!! Form::label('slug', __('Slug')) !!}
    {!! Form::text('slug', null, ['class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''), 'required']) !!}

    @error('title')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group align-items-center">
            <select name="parent_id" class="form-control">
                <option value="">-- {{ __('No parent category') }} --</option>
                @include('admin.categories._categories')
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('status', __('Published'), ['class' => 'mr-2 align-middle']) !!}
            {!! Form::checkbox("status", null) !!}
        </div>
        <div class="form-group">
            {!! Form::label('position', __('Position'), ['class' => 'mr-2 align-middle']) !!}
            {!! Form::number("position", null) !!}
        </div>
    </div>
</div>




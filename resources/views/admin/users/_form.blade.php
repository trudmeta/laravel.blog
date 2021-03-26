@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php
$isAdmin = isset($user) && Auth::user()->can('create', $user)? true : false;
@endphp

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('first_name', __('First name')) !!}
            {!! Form::text('first_name', null, ['class' => 'form-control' . ($errors->has('first_name') ? ' is-invalid' : ''), isset($user)? !$isAdmin? 'disabled' : '' : '']) !!}

            @error('first_name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('last_name', __('Last name')) !!}
            {!! Form::text('last_name', null, ['class' => 'form-control' . ($errors->has('last_name') ? ' is-invalid' : ''), isset($user)? !$isAdmin? 'disabled' : '' : '']) !!}

            @error('last_name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('login', __('Login')) !!}
            {!! Form::text('login', null, ['class' => 'form-control' . ($errors->has('login') ? ' is-invalid' : ''), isset($user)? !$isAdmin? 'disabled' : '' : '']) !!}

            @error('login')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('email', __('E-mail')) !!}
            {!! Form::text('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), isset($user)? !$isAdmin? 'disabled' : '' : '']) !!}

            @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('birthday', __('Birthday')) !!}
            {!! Form::date('birthday') !!}

            @error('birthday')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <select name="role" class="form-control">
        @foreach($roles as $id => $role)
            <option value="{{ $id }}"
                @if(isset($user) && $user->id == $id) selected="selected" @endif
                @if(!$isAdmin) disabled @endif
            >
                {{ $role }}
            </option>
        @endforeach
        </select>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('password', __('Password')) !!}
            {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : '') ]) !!}

            @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('password_confirmation', __('Confirm password')) !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : '') ]) !!}

            @error('password_confirmation')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>


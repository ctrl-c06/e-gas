@extends('layouts.app')
@section('title', 'Create new admin')
@section('content')

@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="usernameValidate">Username</label>
                <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                    id="usernameValidate" name="username">
                @error('username')
                <div class="invalid-feedback">
                    {{ $errors->first('username') }}
                </div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label>Firstname</label>
                <input type="text" class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}"
                    name="firstname" value="{{ old('firstname') }}">
                @error('firstname')
                <p class="text-danger">{{ $errors->first('firstname') }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label>Middlename</label>
                <input type="text" class="form-control {{ $errors->has('middlename') ? 'is-invalid' : '' }}"
                    name="middlename" value="{{ old('middlename') }}">
                @error('middlename')
                <p class="text-danger">{{ $errors->first('middlename') }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label>Lastname</label>
                <input type="text" class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}"
                    name="lastname" value="{{ old('lastname') }}">
                @error('lastname')
                <p class="text-danger">{{ $errors->first('lastname') }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label>Password</label>
                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    name="password">
                @error('password')
                <p class="text-danger">{{ $errors->first('password') }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label>Re-type password</label>
                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    name="password_confirmation">
            </div>

            <div class="float-end">
                <div class="form-group">
                    <input type="submit" value="Create an administrator" class="btn btn-info">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

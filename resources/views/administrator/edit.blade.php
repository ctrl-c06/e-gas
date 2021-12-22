@extends('layouts.app')
@section('title', 'Add New Administrator')
@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="alert alert-info">
        If you want to change your password just fill in the password field.
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-4">
            <label>Username</label>
            <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" value="{{ old('username') ?? $user->username }}">
            @error('username')
                <p class="text-danger">{{ $errors->first('username') }}</p>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label>Firstname</label>
            <input type="text" class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}" name="firstname" value="{{ old('firstname') ?? $user->firstname }}">
            @error('firstname')
                <p class="text-danger">{{ $errors->first('firstname') }}</p>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label>Middlename</label>
            <input type="text" class="form-control {{ $errors->has('middlename') ? 'is-invalid' : '' }}" name="middlename" value="{{ old('middlename') ?? $user->middlename }}">
            @error('middlename')
                <p class="text-danger">{{ $errors->first('middlename') }}</p>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label>Lastname</label>
            <input type="text" class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" name="lastname" value="{{ old('lastname') ?? $user->lastname }}">
            @error('lastname')
                <p class="text-danger">{{ $errors->first('lastname') }}</p>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label>Password</label>
            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password">
            @error('password')
                <p class="text-danger">{{ $errors->first('password') }}</p>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label>Re-type password</label>
            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password_confirmation">
            @error('password')
                <p class="text-danger">{{ $errors->first('password') }}</p>
            @enderror
        </div>

        <div class="float-end">
            <div class="form-group">
                <input type="submit" value="Update administrator" class="btn btn-success text-white">
            </div>
        </div>
    </form>
        </div>
    </div>
@endsection
@extends('layouts.app')
@section('title', 'Edit your profile')
@section('content')
@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif
<div class="card">
    <div class="card-header font-weight-bold display-5">
        Update your profile
    </div>
    <div class="card-body">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-4">
                <label>Username</label>
                <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                    name="username" value="{{ old('username') ?? $user->username }}">
                @error('username')
                    <p class="text-danger">{{ $errors->first('username') }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label>Firstname</label>
                <input type="text" class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}"
                    name="firstname" value="{{ old('firstname') ?? $user->firstname }}">
                @error('firstname')
                    <p class="text-danger">{{ $errors->first('firstname') }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label>Middlename</label>
                <input type="text" class="form-control {{ $errors->has('middlename') ? 'is-invalid' : '' }}"
                    name="middlename" value="{{ old('middlename') ?? $user->middlename }}">
                @error('middlename')
                    <p class="text-danger">{{ $errors->first('middlename') }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label>Lastname</label>
                <input type="text" class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}"
                    name="lastname" value="{{ old('lastname') ?? $user->lastname }}">
                @error('lastname')
                    <p class="text-danger">{{ $errors->first('lastname') }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label>Current Password</label>
                <input type="text" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    name="password" value="">
                @error('password')
                    <p class="text-danger">{{ $errors->first('password') }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label>New Password</label>
                <input type="text" class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}"
                    name="new_password" value="{{ old('new_password') }}">
                @error('new_password')
                    <p class="text-danger">{{ $errors->first('new_password') }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label>Confirm New Password</label>
                <input type="text" class="form-control {{ $errors->has('confirm_password') ? 'is-invalid' : '' }}"
                    name="confirm_password" value="">
                @error('confirm_password')
                    <p class="text-danger">{{ $errors->first('confirm_password') }}</p>
                @enderror
            </div>

            <div class="form-group float-end">
                <button class="text-white btn btn-success d-inline-flex align-items-center" type="submit">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
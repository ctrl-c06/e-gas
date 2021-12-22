@extends('layouts.app')
@section('title', 'Generate Fuel Slip')
@section('content')

@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif
<div class="card">
    <div class="card-body">
        <form action="{{ route('fuel-slip.store') }}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label>Date Issue</label>
                <input type="date" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" name="date"
                    value="{{ old('date') }}">
                @error('date')
                <p class="text-danger">{{ $errors->first('date') }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label>Gasoline Station</label>
                <input type="text" class="form-control {{ $errors->has('gasoline_station') ? 'is-invalid' : '' }}"
                    name="gasoline_station" value="{{ old('gasoline_station') }}">
                @error('gasoline_station')
                <p class="text-danger">{{ $errors->first('gasoline_station') }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label>No. of liters</label>
                <input type="text" class="form-control {{ $errors->has('no_of_liters') ? 'is-invalid' : '' }}"
                    name="no_of_liters" value="{{ old('no_of_liters') }}">
                @error('no_of_liters')
                <p class="text-danger">{{ $errors->first('no_of_liters') }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label>Name of Driver</label>
                <input type="text" class="form-control {{ $errors->has('name_of_driver') ? 'is-invalid' : '' }}"
                    name="name_of_driver" value="{{ old('name_of_driver') }}">
                @error('name_of_driver')
                <p class="text-danger">{{ $errors->first('name_of_driver') }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label>Vechile Plate #</label>
                <input type="text" class="form-control {{ $errors->has('vehicle_plate_no') ? 'is-invalid' : '' }}"
                    name="vehicle_plate_no" value="{{ old('vehicle_plate_no') }}">
                @error('vehicle_plate_no')
                <p class="text-danger">{{ $errors->first('vehicle_plate_no') }}</p>
                @enderror
            </div>


            <div class="float-end">
                <div class="form-group">
                    <input type="submit" value="Generate Fuel Slip" class="btn btn-info">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

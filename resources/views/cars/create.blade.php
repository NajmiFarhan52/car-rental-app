@extends('layouts.app')
@section('content')
    <div class="card mt-4">
        <div class="card-header">Create New Rent</div>
        <div class="card-body">

            <form action="{{ route('cars.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="car_brand">Car Brand</label>
                <input type="text" name="car_brand" class="form-control" value="{{ old('car_brand') }}">
                <label for="car_model">Car Model</label>
                <input type="text" name="car_model" class="form-control" value="{{ old('car_model') }}">
                <label for="car_location">Car Location</label>
                <input type="text" name="car_location" class="form-control" value="{{ old('car_location') }}">
                <label for="car_price">Car Price</label>
                <input type="text" name="car_price" class="form-control" value="{{ old('car_price') }}">
                <label for="car_price">Car Image</label>
                <input type="file" name="car_image" class="form-control">
                <input type="submit" value="Save" class="btn btn-success mt-2">
            </form>
            
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
@endsection
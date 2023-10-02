@extends('layouts.app')
@section('content')
    <div class="card mt-4">
        <div class="card-header">Edit a Rent</div>
        <div class="card-body">

            <form action="{{ route('cars.update', ['car' => $car]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label for="car_brand">Car Brand</label>
                <input type="text" name="car_brand" class="form-control" value="{{ $car->car_brand }}">
                <label for="car_model">Car Model</label>
                <input type="text" name="car_model" class="form-control" value="{{ $car->car_model }}">
                <label for="car_location">Car Location</label>
                <input type="text" name="car_location" class="form-control" value="{{ $car->car_location }}">
                <label for="car_price">Car Price</label>
                <input type="text" name="car_price" class="form-control" value="{{ $car->car_price }}">
                <input type="file" name="car_image" class="form-control">
                <img src="{{ asset($car->car_image) }}" class="img img-thumbnail">
                <input type="submit" value="Save" class="btn btn-success">
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
@extends('layouts.app')
@section('content')
<div class="card my-4 mx-5">
    <div class="card-header">Owner: {{ $car->user->name }}</div>
    <div class="card-body">
        <label for="car_brand" class="fw-bold">Car Brand</label>
        <input type="text" name="car_brand" class="form-control-plaintext" value="{{ $car->car_brand }}" readonly>
        <label for="car_model" class="fw-bold">Car Model</label>
        <input type="text" name="car_model" class="form-control-plaintext" value="{{ $car->car_model }}" readonly>
        <label for="car_location" class="fw-bold">Car Location</label>
        <input type="text" name="car_location" class="form-control-plaintext" value="{{ $car->car_location }}" readonly>
        <label for="car_price" class="fw-bold">Car Price</label>
        <input type="text" name="car_price" class="form-control-plaintext" value="{{ $car->car_price }}" readonly>
        <label for="car_price" class="fw-bold">Car Avalability</label><br>
        @if ($car->car_availability == 1)
            <h6 class="badge bg-success">Available</h6>
        @else
            <h6 class="badge bg-danger">Unavailable</h6>
        @endif
        <br>
        <label class="fw-bold">Car Image</label><br>
        <img src="{{ asset($car->car_image) }}" class="img" style="width: 25%"><br>

        @if (auth()->user()->role == 1 || $car->user->is(auth()->user()))    {{-- render if authorized user or admin --}}
        <a href="{{ route('cars.edit', ['car' => $car]) }}" class="btn btn-success">Edit</a>
        <form action="{{ route('cars.destroy', ['car' => $car]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Delete</button>
        </form>                        
        @endif

        @if ($car->car_availability == 1)   {{-- render Book button if avaiable --}}
        @unless ($car->user->is(auth()->user()))    {{-- render for everyone except authorized user --}}
        <a href="{{ route('bookings.create', ['car' => $car]) }}" class="btn btn-warning">Book</a>
        @endunless           
        @endif


    </div>
</div>
@endsection
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-4">
                <div class="card">
                    <div class="card-header">
                        @if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            {{ Session::get('flash_message') }}
                        </div>
                        @endif
                    </div>
                    <div class="car-body">
                        <h1>Booking History</h1>
                        <br/>
                    </div>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pickup Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                        <th>Total Price</th>
                        <th>Car</th>
                        <th>Owner</th>
                        <th>Booker</th>
                        <th>Option</th>    
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                    @if (auth()->user()->role == 1 || $booking->car->user->is(auth()->user()) || $booking->user->is(auth()->user()))
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->pickup_date->format('d-m-Y') }}</td>
                        <td>{{ $booking->return_date->format('d-m-Y') }}</td>
                        @if ($booking->status === "booked")
                            <td class="badge rounded-pill bg-warning mt-2">{{ $booking->status }}</td>
                        @endif
                        @if ($booking->status === "approved")
                            <td class="badge rounded-pill bg-success text-white mt-2">{{ $booking->status }}</td>
                        @endif
                        @if ($booking->status === "rejected")
                            <td class="badge rounded-pill bg-danger text-white mt-2">{{ $booking->status }}</td>
                        @endif
                        @if ($booking->status === "reopened")
                            <td class="badge rounded-pill bg-info mt-2">{{ $booking->status }}</td>
                        @endif
                        @if ($booking->status === "cancelled")
                            <td class="badge rounded-pill bg-secondary text-white mt-2">{{ $booking->status }}</td>
                        @endif
                        
                        <td>{{ $booking->total_price }}</td>
                        <td>{{ $booking->car->car_brand }} {{ $booking->car->car_model }}</td>
                        <td>{{ $booking->car->user->name }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>
                            <a href="{{ route('bookings.show', ['booking' => $booking]) }}" class="btn btn-primary mt-2">View</a>
                        </td>
                        
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
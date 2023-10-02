@extends('layouts.app')
@section('content')
<div class="card my-4 mx-5">
    <div class="card-header">Booker: {{ $booking->user->name }}</div>
    <div class="card-body">
        <form action="{{ route('bookings.update', ['booking' => $booking])}}" method="post">
            @csrf
            @method('PATCH')
            <label for="booking_id" class="fw-bold">Booking ID</label>
            <input type="text" name="booking_id" class="form-control-plaintext" value="{{ $booking->id }}" readonly>
            <label for="pickup_date" class="fw-bold">PickUp Date</label>
            <input type="text" name="pickup_date" class="form-control-plaintext" value="{{ $booking->pickup_date->format('d-m-Y') }}" readonly>
            <label for="return_date" class="fw-bold">Return Date</label>
            <input type="text" name="return_date" class="form-control-plaintext" value="{{ $booking->return_date->format('d-m-Y') }}" readonly>
            <label for="status" class="fw-bold">Status</label>
            <input type="text" name="status" class="form-control-plaintext" value="{{ $booking->status }}" readonly>
            <label for="total_price" class="fw-bold">Total Price</label><br>
            <input type="text" name="total_price" class="form-control-plaintext" value="{{ $booking->total_price }}" readonly>
            <br>

            @if ($booking->user->is(auth()->user()))
                @if ($booking->status === 'booked')
                    <button type="submit" class="btn btn-secondary" name="cancel">CANCEL</button>
                @endif   
            @endif
    
            @if ($booking->car->user->is(auth()->user()))
                @if ($booking->status === 'booked' && $booking->car->car_availability == 1)
                <button type="submit" class="btn btn-warning" name="approve">APPROVE</button>
                <button type="submit" class="btn btn-warning" name="reject">REJECT</button> 
                @endif
                
                @if ($booking->status === 'approved')
                <button type="submit" class="btn btn-warning" name="reopen">REOPEN</button>
                @endif
        </form>
            @endif

            @if (auth()->user()->role == 1)
            <form action="{{ route('bookings.destroy', ['booking' => $booking])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-4" name="delete">DELETE</button>
            </form>                
            @endif


                
            
    </div>
</div>
@endsection
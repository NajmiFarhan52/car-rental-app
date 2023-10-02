@extends('layouts.app')
@section('content')
    <div class="card mt-4">
        <div class="card-header">Book this Car</div>
        <div class="card-body">

            <form action="{{ route('bookings.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <img src="{{ asset($car->car_image) }}" class="img img-thumbnail" style="width: 25%"> <br>
                <label for="car_availability">Availability</label><br>
                @if ($car->car_availability == 1)
                        <h6 class="badge bg-success">Available</h6>
                @else
                        <h6 class="badge bg-danger">Unavailable</h6>
                @endif
                <br>
                <label for="car_price">Price per Day</label>
                <input type="text" name="car_price" class="form-control" value="{{ $car->car_price }}" readonly>
                <label for="pickup_date">PickUp Date</label>
                <input type="date" name="pickup_date" class="form-control">
                <label for="return_date">Return Date</label>
                <input type="date" name="return_date" class="form-control" onchange="calculateTotalPrice()">

                <br>
                <span id="total_day_label"></span>  
                <br>
                <span id="total_price_label"></span>
                <br><br>

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> 
                <input type="hidden" name="car_id" value="{{ $car->id }}"> 
                <input type="hidden" name="status" value="booked">
                <input type="hidden" name="total_price" id="total_price" readonly>
                
                <input type="submit" value="Book" class="btn btn-success">
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

<script>
    console.log("HAHA");
    function calculateTotalPrice() {
        console.log('calculateTotalPrice function called');
        // Get the selected pickup and return dates
        const pickupDate = new Date(document.querySelector('input[name="pickup_date"]').value);
        const returnDate = new Date(document.querySelector('input[name="return_date"]').value);

        // Calculate the number of days rented
        const oneDay = 24 * 60 * 60 * 1000; // Number of milliseconds in a day
        const numberOfDays = Math.round(Math.abs((returnDate - pickupDate) / oneDay));

        // Get the price per day from the form input
        const pricePerDay = parseFloat(document.querySelector('input[name="car_price"]').value);

        // Calculate the total price
        const totalPrice = pricePerDay * numberOfDays;

        // Display the total price in the <span> element
        const totalPriceLabel = document.getElementById('total_price_label');
        const totalDayLabel = document.getElementById('total_day_label');
        totalPriceLabel.textContent = 'Total Price: RM' + totalPrice.toFixed(2); // Format as currency
        totalDayLabel.textContent = 'Total Day: ' + numberOfDays;

        //pass the total Price to hidden input
        const totalPriceInput = document.getElementById('total_price');
        totalPriceInput.value = totalPrice.toFixed(2);
    }
</script>

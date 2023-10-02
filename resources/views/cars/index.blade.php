@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-4">
                        @if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            {{ Session::get('flash_message') }}
                        </div>
                        @endif
                    <div class="car-body">
                        @if (auth()->user()->role == 0)
                        <a href="{{ route('cars.create') }}" class="btn btn-success mt-2 ms-2">Create</a>
                        @endif
                        
                        
                        <input type="search" class="searchbox form-control mt-2" id="live-search" onkeyup="buttonUp();" placeholder="Search & Filter">
                    </div>
                </div>
            </div>

        <div class="row pt-3">
            @foreach ($cars as $car)
            <div class="card mx-3 my-2" style="width: 18rem">
                <div class="card-body">
                    <h5>{{ $car->car_brand }}</h5>
                    <h6 id="car_model">{{ $car->car_model }}</h6>
                    <h6 id="car_location">{{ $car->car_location }}</h6>
                    <h6>RM{{ $car->car_price }} (per day)</h6>
                    <h6>Owner: <span class="fw-bold">{{ $car->user->name }}</span></h6>
                    <h6>Created at: {{ $car->created_at->addHours(8)->format('j M Y, g:i a') }}</h6>
                    @if ($car->car_availability == 1)
                        <h6 class="badge bg-success">Available</h6>
                    @else
                        <h6 class="badge bg-danger">Unavailable</h6>
                    @endif
                    
                    <img src="{{ asset($car->car_image) }}" class="img img-thumbnail">

                    <a href="{{ route('cars.show', ['car' => $car]) }}" class="btn btn-warning mt-2">View</a>

                </div>
            </div>                
            @endforeach
        </div>

        </div>
    </div>

@endsection

<script>
var buttonUp = () => {
    const input = document.querySelector(".searchbox");
    const cards = document.getElementsByClassName("card");
    let filter = input.value
    console.log(filter);
    for (let i = 0; i < cards.length; i++) {
        let title = cards[i].querySelector(".card-body");
        if (title.innerText.toLowerCase().indexOf(filter) > -1) {
            cards[i].classList.remove("d-none") //visible
        } else {
            cards[i].classList.add("d-none") //invisible
        }
    }
}
</script>
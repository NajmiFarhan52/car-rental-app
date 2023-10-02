<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Car $car)
    {
        return view('bookings.create')->with('car', $car);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pickup_date' => 'required',
            'return_date' => 'required',
            'status' => 'required',
            'total_price' => 'required',
            'car_id' => 'required',
            'user_id' => 'required'
        ]);

        // dd($validatedData);

        Booking::create($validatedData);

        return redirect()->route('bookings.index')->with('flash_message', 'Booking Created Successfully');
        
    }

    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index')->with('bookings', $bookings);
    }

    public function show(Booking $booking)
    {
        return view('bookings.show')->with('booking', $booking);
    }

    public function update(Request $request, Booking $booking)
    {
        if ($request->has('approve')) {
            $booking->update(['status' => 'approved']);
        } elseif ($request->has('reject')) {
            $booking->update(['status' => 'rejected']);
        } elseif ($request->has('reopen')){
            $booking->update(['status' => 'reopened']);
        } elseif ($request->has('cancel')){
            $booking->update(['status' => 'cancelled']);
        }

        //get car id
        $car = Car::find($booking->car_id);
        // Update the car's availability
        if ($booking->status === 'approved') {
            $car->car_availability = 0;
        } elseif ($booking->status === 'rejected'){
            $car->car_availability = 1;
        } elseif ($booking->status === 'reopened'){
            $car->car_availability = 1;
        }

        //update car
        $car->save();

        return redirect()->route('bookings.index')->with('flash_message', 'Booking status updated successfully');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')->with('flash_message', 'Booking deleted Successfully');
    }
}

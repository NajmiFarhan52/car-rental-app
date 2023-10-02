<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view('cars.index')->with('cars', $cars);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'car_brand' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'car_location' => 'required|string|max:255',
            'car_price' => 'required|string|max:255',
            'car_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Adjust the validation rules as needed
        ]);

        // Handle the image upload
        $fileName = time() . '.' . $request->file('car_image')->getClientOriginalExtension();
        $path = $request->file('car_image')->storeAs('images', $fileName, 'public');

        // Prepare data for database insertion
        $data = [
            'car_brand' => $validatedData['car_brand'],
            'car_model' => $validatedData['car_model'],
            'car_location' => $validatedData['car_location'],
            'car_price' => $validatedData['car_price'],
            'car_image' => '/storage/' . $path,
        ];

        // Create a new car record in the database
        // Car::create($data);
        $request->user()->cars()->create($data);

        // Redirect back with a flash message
        return redirect()->route('cars.index')->with('flash_message', 'Car Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('cars.show')->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('cars.edit')->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {

        // Validate the form data
        $validatedData = $request->validate([
            'car_brand' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'car_location' => 'required|string|max:255',
            'car_price' => 'required|string|max:255',
            'car_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Adjust the validation rules as needed
        ]);

        // Handle the image update if a new image is provided
        if ($request->hasFile('car_image')) {
            $fileName = time() . '.' . $request->file('car_image')->getClientOriginalExtension();
            $path = $request->file('car_image')->storeAs('images', $fileName, 'public');
            $car->car_image = '/storage/' . $path;
        }

        // Update the car variables
        $car->car_brand = $validatedData['car_brand'];
        $car->car_model = $validatedData['car_model'];
        $car->car_location = $validatedData['car_location'];
        $car->car_price = $validatedData['car_price'];

        // Save the updated car record
        $car->save();

        // Redirect back with a flash message
        return redirect()->route('cars.index')->with('flash_message', 'Car Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('flash_message', 'Car Deleted Successfully');
    }
}

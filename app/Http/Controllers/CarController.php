<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Models\Car;
use App\Models\Rental;
use Carbon\Carbon;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return response()->json(['data' => $cars]);
    }

    public function store(StoreCarRequest $request) {
        $car = new Car($request->only('license_plate_number', 'brand', 'model', 'daily_cost'));
        $car->save();
        return response()->json($car, 201);
    }

    public function rent(Car $car) {
        $count = Rental::where('car_id', $car->id)
        ->where('start_date', '<=', Carbon::now())
        ->where('end_date', '>=', Carbon::now())
        ->count();

        if ($count > 0) 
        {
            return response()->json(['message' => 'A foglalás már megtörtént!'], 409);
        }

        $rental = new Rental();
        $rental->car_id = $car->id;
        $rental->start_date = Carbon::now();
        $rental->end_date = Carbon::now()->addWeek();

        $rental->save();

        return response()->json($rental, 201);

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use App\Services\CarService;

class CarController extends Controller
{
    protected $carService;

    public function __construct(CarService $carService)
    {
        return $this->carService = $carService;
    }

    public function index()
    {
        return $this->carService->getCarsOwnedByUser(auth()->user()->cars);
    }

    public function store(CreateCarRequest $request)
    {
        return $this->carService->createCar($request->data());
    }

    public function show(Car $id)
    {
        return $this->carService->getCarById($id);
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
        return $this->carService->updateCar($car, $request->data());
    }

    public function destroy(Car $id)
    {
        return $this->carService->deleteCar($id);
    }
}

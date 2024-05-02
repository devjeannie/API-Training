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
        $this->carService = $carService;
    }

    public function index()
    {
        $this->carService->getCarsOwnedByUser();
    }

    public function store(CreateCarRequest $request)
    {
        $this->carService->createCar($request->data());
    }

    public function show(Car $id)
    {
        $this->carService->getCarById($id);
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
        $this->carService->updateCar($car, $request->data());
    }

    public function destroy(Car $id)
    {
        $this->carService->deleteCar($id);
    }
}

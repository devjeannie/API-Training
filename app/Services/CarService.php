<?php

namespace App\Services;

use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CarService
{
    public function getAllCars(): ResourceCollection
    {
        return CarResource::collection(Car::all());  
    }

    public function getCarsOwnedByUser(): ResourceCollection
    {
        $cars = auth()->guard('api')->user()->cars()->get();
        return CarResource::collection($cars);  
    }

    public function createCar($data): JsonResponse
    {
        DB::beginTransaction();

        try {
            Car::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);

            return response()->json(['result' => false]);
        }

        return response()->json(['result' => true]);
    }

    public function getCarById(Car $car): JsonResource
    {
        return new CarResource($car);
    }

    public function updateCar(Car $car, $data): JsonResponse
    {
        DB::beginTransaction();

        try {
            $car->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);

            return response()->json(['result' => false]);
        }

        return response()->json(['result' => true]);
    }

    public function deleteCar(Car $car): JsonResponse
    {
        DB::beginTransaction();

        try {
            $car->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);

            return response()->json(['result' => false]);
        }

        return response()->json(['result' => true]);
    }
}

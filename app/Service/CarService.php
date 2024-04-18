<?php

namespace App\Services;

use App\Models\Car;

class CarService
{
    protected $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function getAll()
    {
        return $this->car->all();
    }

    public function getById($id)
    {
        return $this->car->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->car->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->getById($id);
        $record->update($data);

        return $record;
    }

    public function delete($id)
    {
        $record = $this->getById($id);
        $record->delete();

        return $record;
    }
}

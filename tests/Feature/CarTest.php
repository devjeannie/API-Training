<?php

namespace Tests\Feature;

use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\User;
use App\Services\CarService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/api/cars');
        $response->assertStatus(200);
    }

    public function test_store() 
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $carData = [
            'user_id' => $user->id,
            'name' => 'Car',
            'model' => 'Camry',
            'make' => 'Toyota',
            'vin' => '4Y1-SL658-4-8-Z-41-1439',
        ];

        $response = $this->post('api/cars', $carData);
        $response->assertStatus(200);
    }

    public function test_show() 
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $car = Car::factory()->create();
        $response = $this->getJson('/api/cars/'.$car->id);
        $response->assertStatus(200);
    }


    public function test_update() 
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $car = Car::factory()->create();

        $updatedData = [
            'name' => 'Car',
            'model' => 'Camry',
            'make' => 'Toyota',
            'vin' => '4Y1-SL658-4-8-Z-41-1439',
        ];

        $response = $this->postJson('/api/cars/'.$car->id, $updatedData);
        $response->assertStatus(200); 
    }

    public function test_delete() 
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $car = Car::factory()->create();
        $response = $this->deleteJson('/api/cars/'.$car->id);
        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating, reading, updating, and deleting users and cars.
     *
     * @return void
     */
    public function testUsersAndCarsCRUD()
    {
        $user = User::factory()->create();
        $cars = Car::factory(3)->create(['user_id' => $user->id]);
        $response = $this->get("/users/cars");
        $response->assertStatus(200);
        foreach ($cars as $car) {
            $response->assertSee($car->name);
            // Add assertions to check other car details if needed
        }

        // Test creating a new car for the user
        $newCarData = [
            'name' => 'New Car',
            // Add other fields as needed
        ];
        $response = $this->post("/users/{$user->id}/cars", $newCarData);
        $response->assertStatus(201);
        $response->assertSee($newCarData['name']);
        // Add assertions to check other car details if needed

        // Test updating the first car
        $updatedCarData = [
            'name' => 'Updated Car Name',
            // Add other fields as needed
        ];
        $response = $this->put("/users/{$user->id}/cars/{$cars[0]->id}", $updatedCarData);
        $response->assertStatus(200);
        $response->assertSee($updatedCarData['name']);
        // Add assertions to check other updated car details if needed

        // Test deleting the second car
        $response = $this->delete("/users/{$user->id}/cars/{$cars[1]->id}");
        $response->assertStatus(204);

        // Verify the car has been deleted
        $this->assertDatabaseMissing('cars', ['id' => $cars[1]->id]);
    }
}

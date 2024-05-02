<?php

namespace Tests\Unit;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_cars()
    {
        $user = User::factory()->create();
        $relatedUser = $user->cars;
        $this->assertInstanceOf(Car::class, $relatedUser);
        $this->assertEquals($user->id, $relatedUser->user_id);
    }
}

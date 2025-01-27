<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function test_admin_user_creation()
    {
        $admin = User::factory()->admin()->create();

        $this->assertEquals('ADMIN', $admin->type);

        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'type' => 'ADMIN',
        ]);
    }

    public function test_user_creation()
    {
        $user = User::factory()->user()->create();

        $this->assertEquals('USER', $user->type);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'type' => 'USER',
        ]);
    }
}

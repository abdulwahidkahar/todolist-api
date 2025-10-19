<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoFeatureTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Cannot create todo without Login.
     */
    public function test_guest_cannot_create_todo()
    {
        $payload = [
            'title' => 'Learning Laravel',
            'deadline' => now()->addDays(30),
        ];

        $response = $this->postJson('/api/todos', $payload);
        $response->assertStatus(401);
    }

    /**
     * User can create New todo
     * @return void
     */
    public function test_user_can_create_todo()
    {
        $user = User::factory()->create();

        $payload = [
            'title' => 'Learning Laravel',
            'deadline' => '2025-10-19',
            'user_id' => $user->id,
        ];

        $response = $this->actingAs($user)->postJson('/api/todos', $payload);
        $response->assertStatus(201);

        $data = [
            'title' => 'Learning Laravel',
            'deadline' => '2025-10-19',
            'user_id' => $user->id,
        ];

        $this->assertDatabaseHas('todos', $data);
    }

    /**
     * User can Update todo
     * @return void
     */
    public function test_user_can_update_todo()
    {
        $user = User::factory()->create();
        $todo = Todo::factory()->create([
            'user_id' => $user->id,
            'title' => 'Learning Laravel',
            'deadline' => '2025-10-19',
        ]);

        $payload = [
            'title' => 'Learning Laravel update',
            'deadline' => '2025-10-19'
        ];

        $response = $this->actingAs($user)->putJson("/api/todos/{$todo->id}", $payload);
        $response->assertStatus(200);

        $data = [
            'title' => 'Learning Laravel update',
            'deadline' => '2025-10-19',
            'user_id' => $user->id,
        ];

        $this->assertDatabaseHas('todos', $data);
    }

    /**
     * User can Delete todo
     * @return void
     */
    public function test_user_can_delete_todo()
    {
        $user = User::factory()->create();
        $todo = Todo::factory()->create([
            'user_id' => $user->id,
            'title' => 'Testing can Delete',
            'deadline' => '2025-10-19',
        ]);

        $response = $this->actingAs($user)->deleteJson("/api/todos/{$todo->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('todos', $todo->toArray());
    }
}

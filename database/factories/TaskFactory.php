<?php

namespace Database\Factories;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'description' => fake()->text(100),
            'status_id' => TaskStatus::find(rand(1, count(TaskStatus::all()))),
            'created_by_id' => User::find(rand(1, count(User::all()))),
            'assigned_to_id' => User::find(rand(1, count(User::all()))),
        ];
    }
}

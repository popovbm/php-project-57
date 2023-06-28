<?php

namespace Database\Factories;

use App\Models\Label;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Label>
 */
class LabelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $label = Label::all()->random();
        return [
            'name' => fake()->unique()->name(),
            'description' => fake()->text(100),
            'created_by_id' => User::all()->random(),
        ];
    }
}

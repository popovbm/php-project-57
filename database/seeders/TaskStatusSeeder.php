<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaskStatus;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskStatus::factory()
            ->count(4)
            ->sequence(
                ['name' => 'новая'],
                ['name' => 'выполняется'],
                ['name' => 'в архиве'],
                ['name' => 'завершена'],
            )
            ->create();
    }
}

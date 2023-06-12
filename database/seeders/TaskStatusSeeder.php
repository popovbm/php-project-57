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
                ['name' => 'новый', 'creator_id' => 1],
                ['name' => 'в работе', 'creator_id' => 1],
                ['name' => 'на тестировании', 'creator_id' => 1],
                ['name' => 'завершен', 'creator_id' => 1],
            )
            ->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskLableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Task::all() as $task) {
            $label = Label::all()->random(random_int(0, Label::count()));
            $task->labels()->attach($label);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Label::factory()
            ->count(4)
            ->sequence(
                ['name' => 'ошибка', 'description' => 'Какая-то ошибка в коде или проблема с функциональностью', 'created_by_id' => 1],
                ['name' => 'документация', 'description' => 'Задача которая касается документации', 'created_by_id' => 1],
                ['name' => 'дубликат', 'description' => 'Повтор другой задачи', 'created_by_id' => 1],
                ['name' => 'доработка', 'description' => '	Новая фича, которую нужно запилить', 'created_by_id' => 1],
            )
            ->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Label;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                ['name' => 'ошибка', 'description' => 'Какая-то ошибка в коде или проблема с функциональностью'],
                ['name' => 'документация', 'description' => 'Задача которая касается документации'],
                ['name' => 'дубликат', 'description' => 'Повтор другой задачи'],
                ['name' => 'доработка', 'description' => '	Новая фича, которую нужно запилить'],
            )
            ->create();
    }

}

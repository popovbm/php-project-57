<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(16)
            ->sequence(
                [
                    'name' => 'Абрамова Дарья Дмитриевна',
                    'email' => 'test@test.com',
                    'password' => '123123123'
                ],
                ['name' => 'Адриан Фёдорович Самойлов'],
                ['name' => 'Веселова Фаина Сергеевна'],
                ['name' => 'Владлен Алексеевич Большаков'],
                ['name' => 'Власова Розалина Владимировна'],
                ['name' => 'Григорьева Ксения Андреевна'],
                ['name' => 'Захарова Ника Андреевна'],
                ['name' => 'Кулаков Антон Евгеньевич'],
                ['name' => 'Любовь Андреевна Кулагина'],
                ['name' => 'Максим Евгеньевич Савельев'],
                ['name' => 'Оксана Андреевна Веселова'],
                ['name' => 'Рада Львовна Хохлова'],
                ['name' => 'Сафонов Семён Дмитриевич'],
                ['name' => 'Селиверстов Трофим Дмитриевич'],
                ['name' => 'Мамонтова Екатерина Максимовна'],
                ['name' => 'Пётр Евгеньевич Рожков'],
            )
            ->create();
    }
}

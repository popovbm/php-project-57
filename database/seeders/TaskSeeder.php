<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::factory()
            ->count(16)
            ->sequence(
                [
                    'name' => 'Исправить ошибку в какой-нибудь строке',
                    'description' => 'Я тут ошибку нашёл, надо бы её исправить и так далее и так далее',
                    'created_by_id' => User::where('name', 'Оксана Андреевна Веселова')->value('id'),
                    'assigned_to_id' => User::where('name', 'Владлен Алексеевич Большаков')->value('id'),
                    'status_id' => TaskStatus::where('name', 'новая')->value('id'),
                ],
                [
                    'name' => 'Допилить дизайн главной страницы',
                    'description' => 'Вёрстка поехала в далёкие края. Нужно удалить бутстрап!',
                    'created_by_id' => User::where('name', 'Рада Львовна Хохлова')->value('id'),
                    'assigned_to_id' => User::where('name', 'Захарова Ника Андреевна')->value('id'),
                    'status_id' => TaskStatus::where('name', 'новая')->value('id'),
                ],
                [
                    'name' => 'Отрефакторить авторизацию',
                    'description' => 'Выпилить всё легаси, которое найдёшь',
                    'created_by_id' => User::where('name', 'Адриан Фёдорович Самойлов')->value('id'),
                    'assigned_to_id' => User::where('name', 'Адриан Фёдорович Самойлов')->value('id'),
                    'status_id' => TaskStatus::where('name', 'новая')->value('id'),
                ],
                [
                    'name' => 'Доработать команду подготовки БД',
                    'description' => 'За одно добавить тестовых данных',
                    'created_by_id' => User::where('name', 'Селиверстов Трофим Дмитриевич')->value('id'),
                    'assigned_to_id' => User::where('name', 'Оксана Андреевна Веселова')->value('id'),
                    'status_id' => TaskStatus::where('name', 'завершена')->value('id'),
                ],
                [
                    'name' => 'Пофиксить вон ту кнопку',
                    'description' => 'Кажется она не того цвета',
                    'created_by_id' => User::where('name', 'Любовь Андреевна Кулагина')->value('id'),
                    'assigned_to_id' => User::where('name', 'Любовь Андреевна Кулагина')->value('id'),
                    'status_id' => TaskStatus::where('name', 'в архиве')->value('id'),
                ],
                [
                    'name' => 'Исправить поиск',
                    'description' => 'Не ищет то, что мне хочется',
                    'created_by_id' => User::where('name', 'Адриан Фёдорович Самойлов')->value('id'),
                    'assigned_to_id' => User::where('name', 'Кулаков Антон Евгеньевич')->value('id'),
                    'status_id' => TaskStatus::where('name', 'новая')->value('id'),
                ],
                [
                    'name' => 'Добавить интеграцию с облаками',
                    'description' => 'Они такие мягкие и пушистые',
                    'created_by_id' => User::where('name', 'Кулаков Антон Евгеньевич')->value('id'),
                    'assigned_to_id' => User::where('name', 'Максим Евгеньевич Савельев')->value('id'),
                    'status_id' => TaskStatus::where('name', 'выполняется')->value('id'),
                ],
                [
                    'name' => 'Выпилить лишние зависимости',
                    'description' => '',
                    'created_by_id' => User::where('name', 'Селиверстов Трофим Дмитриевич')->value('id'),
                    'assigned_to_id' => User::where('name', 'Абрамова Дарья Дмитриевна')->value('id'),
                    'status_id' => TaskStatus::where('name', 'новая')->value('id'),
                ],
                [
                    'name' => 'Запилить сертификаты',
                    'description' => 'Кому-то же они нужны?',
                    'created_by_id' => User::where('name', 'Абрамова Дарья Дмитриевна')->value('id'),
                    'assigned_to_id' => User::where('name', 'Любовь Андреевна Кулагина')->value('id'),
                    'status_id' => TaskStatus::where('name', 'выполняется')->value('id'),
                ],
                [
                    'name' => 'Выпилить игру престолов',
                    'description' => 'Этот сериал никому не нравится! :)',
                    'created_by_id' => User::where('name', 'Веселова Фаина Сергеевна')->value('id'),
                    'assigned_to_id' => User::where('name', 'Власова Розалина Владимировна')->value('id'),
                    'status_id' => TaskStatus::where('name', 'новая')->value('id'),
                ],
                [
                    'name' => 'Пофиксить спеку во всех репозиториях',
                    'description' => 'Передать Олегу, чтобы больше не ронял прод',
                    'created_by_id' => User::where('name', 'Селиверстов Трофим Дмитриевич')->value('id'),
                    'assigned_to_id' => User::where('name', 'Владлен Алексеевич Большаков')->value('id'),
                    'status_id' => TaskStatus::where('name', 'новая')->value('id'),
                ],
                [
                    'name' => 'Вернуть крошки',
                    'description' => 'Андрей, это задача для тебя',
                    'created_by_id' => User::where('name', 'Адриан Фёдорович Самойлов')->value('id'),
                    'assigned_to_id' => User::where('name', 'Абрамова Дарья Дмитриевна')->value('id'),
                    'status_id' => TaskStatus::where('name', 'в архиве')->value('id'),
                ],
                [
                    'name' => 'Установить Linux',
                    'description' => 'Не забыть потестировать',
                    'created_by_id' => User::where('name', 'Сафонов Семён Дмитриевич')->value('id'),
                    'assigned_to_id' => User::where('name', 'Кулаков Антон Евгеньевич')->value('id'),
                    'status_id' => TaskStatus::where('name', 'новая')->value('id'),
                ],
                [
                    'name' => 'Потребовать прибавки к зарплате',
                    'description' => 'Кризис это не время, чтобы молчать!',
                    'created_by_id' => User::where('name', 'Захарова Ника Андреевна')->value('id'),
                    'assigned_to_id' => User::where('name', 'Максим Евгеньевич Савельев')->value('id'),
                    'status_id' => TaskStatus::where('name', 'в архиве')->value('id'),
                ],
                [
                    'name' => 'Добавить поиск по фото',
                    'description' => 'Только не по моему',
                    'created_by_id' => User::where('name', 'Селиверстов Трофим Дмитриевич')->value('id'),
                    'assigned_to_id' => User::where('name', 'Любовь Андреевна Кулагина')->value('id'),
                    'status_id' => TaskStatus::where('name', 'завершена')->value('id'),
                ],
                [
                    'name' => 'Съесть еще этих прекрасных французских булочек',
                    'description' => '',
                    'created_by_id' => User::where('name', 'Пётр Евгеньевич Рожков')->value('id'),
                    'assigned_to_id' => User::where('name', 'Мамонтова Екатерина Максимовна')->value('id'),
                    'status_id' => TaskStatus::where('name', 'завершена')->value('id'),
                ],
            )
            ->create();
    }
}

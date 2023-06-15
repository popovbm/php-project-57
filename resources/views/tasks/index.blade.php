@extends('layouts.main')

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5 text-black dark:text-white text-5xl">Задачи</h1>

            <table class="mt-4 text-black dark:text-white border-collapse border border-slate-500">
                <thead>
                    <tr>
                        <th class="border border-black dark:border-white p-1">ID</th>
                        <th class="border border-black dark:border-white p-1">Статус</th>
                        <th class="border border-black dark:border-white p-1">Имя</th>
                        <th class="border border-black dark:border-white p-1">Автор</th>
                        <th class="border border-black dark:border-white p-1">Исполнитель</th>
                        <th class="border border-black dark:border-white p-1">Дата создания</th>
                        @can('seeActions', App\Models\Task::class)
                        <th class="border border-black dark:border-white p-1">Действия</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr class="text-left">
                        <td class="border border-black dark:border-white p-1">{{ $task->id }}</td>
                        <td class="border border-black dark:border-white p-1">{{ $task->status->name }}</td>
                        <td class="border border-black dark:border-white p-1">
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.show', $task) }}">
                                {{ $task->name }}
                            </a>
                        </td>
                        <td class="border border-black dark:border-white p-1">{{ $task->creator->name }}</td>
                        <td class="border border-black dark:border-white p-1">{{ $task->performer->name ?? '' }} </td>
                        <td class="border border-black dark:border-white p-1">{{ $task->created_at->format('d.m.Y') }}</td>
                        @can('update', $task)
                        <td class="border border-black dark:border-white p-1">
                            <a class=" text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task) }}">{{ __('layout.table_edit') }}</a>
                            @can('delete', $task)
                            <a data-confirm="Вы уверены?" class="text-red-600 hover:text-red-900" href="{{ route('tasks.destroy', $task) }}" data-method="delete" rel="nofollow">{{ __('layout.table_delete') }}</a>
                            @endcan
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 grid col-span-full">
                {{ $tasks->links() }}
            </div>
        </div>
</section>
@endsection
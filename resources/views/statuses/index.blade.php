@extends('layouts.main')

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5 text-black dark:text-white text-5xl">{{ __('layout.task_statuses_header') }}</h1>
            @can('create', App\Models\TaskStatus::class)
            <a class="text-white hover:text-red-900" href="{{ route('task_statuses.create') }}">{{ __('layout.task_statuses_create') }}</a>
            @endcan

            <table class="mt-4 text-black dark:text-white border-collapse border border-slate-500">
                <thead>
                    <tr class="text-left">
                        <th class="border border-black dark:border-white p-1">{{ __('layout.table_id') }}</th>
                        <th class="border border-black dark:border-white p-1">{{ __('layout.table_name') }}</th>
                        <th class="border border-black dark:border-white p-1">{{ __('layout.table_date_of_creation') }}</th>
                        @can('seeActions', App\Models\TaskStatus::class)
                        <th class="border border-black dark:border-white p-1">{{ __('layout.table_actions') }}</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($taskStatuses as $taskStatus)
                    <tr class="text-left">
                        <td class="border border-black dark:border-white p-1">{{ $taskStatus->id }}</td>
                        <td class="border border-black dark:border-white p-1">{{ $taskStatus->name }}</td>
                        <td class="border border-black dark:border-white p-1">{{ $taskStatus->created_at->format('d.m.Y') }}</td>
                        @canany(['delete', 'update'], $taskStatus)
                        <td class="border border-black dark:border-white p-1">
                            <a data-confirm="Вы уверены?" class="text-red-600 hover:text-red-900" href="{{ route('task_statuses.destroy', $taskStatus) }}" data-method="delete" rel="nofollow">{{ __('layout.table_delete') }}</a>
                            <a class=" text-blue-600 hover:text-blue-900" href="{{ route('task_statuses.edit', $taskStatus) }}">{{ __('layout.table_edit') }}</a>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
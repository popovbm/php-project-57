@extends('layouts.main')

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h2 class="mb-5 text-black dark:text-white text-3xl">
                {{ __('layout.task.show_header') }}: {{ $task->name}} <a href="{{ route('tasks.edit', $task)}}" class='bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded'>{{ __('layout.button.edit') }}</a>
            </h2>
            <div class="text-black dark:text-white">
                <p class="pb-1"><span>{{ __('layout.task.show_name') }}</span>{{ $task->name}}</p>
                <p class="pb-1"><span>{{ __('layout.task.show_status') }}</span>{{ $task->status->name }}</p>
                <p class="pb-1"><span>{{ __('layout.task.show_description') }}</span>{{ $task->description }}</p>
                <p class="pb-1"><span>{{ __('layout.task.show_labels') }}</span></p>
            </div>
        </div>
    </div>
</section>
@endsection

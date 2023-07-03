@extends('layouts.main')

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5 text-black dark:text-white text-5xl">{{ __('layout.task.edit') }}</h1>

            @if ($errors->any())
            @include('components.show-form-errors')
            @endif

            {{ Form::model($task, ['route' => ['tasks.update', $task], 'method' => 'PATCH', 'class' => 'w-50']) }}
            <div class="flex flex-col">
                <div>
                    {{ Form::label('name', __('layout.task.name'), ['class' => 'text-black dark:text-white']) }}
                </div>
                <div class="mt-2">
                    {{ Form::text('name') }}
                </div>
                <div class="mt-2">
                    {{ Form::label('description', __('layout.task.description'), ['class' => 'text-black dark:text-white']) }}
                </div>
                <div>
                    {{ Form::textarea('description') }}
                </div>
                <div class="mt-2">
                    {{ Form::label('status_id', __('layout.task.status'), ['class' => 'text-black dark:text-white']) }}
                </div>
                <div>
                    {{ Form::select('status_id', $statuses, $task->status_id, ['class' => 'form-control rounded border-gray-300 w-1/3', 'placeholder' => '----------']) }}
                </div>
                <div class="mt-2">
                    {{ Form::label('assigned_to_id', __('layout.task.assigned'), ['class' => 'text-black dark:text-white']) }}
                </div>
                <div>
                    {{ Form::select('assigned_to_id', $users, $task->assigned_to_id, ['class' => 'form-control rounded border-gray-300 w-1/3', 'placeholder' => '----------']) }}
                </div>
                <div class="mt-2">
                    {{ Form::label('labels', __('layout.task.labels'), ['class' => 'text-black dark:text-white']) }}
                </div>
                <div>
                    {{ Form::select('labels[]', $labels, $task->labels, ['class' => 'form-control rounded border-gray-300 w-1/3', 'multiple' => 'multiple', 'placeholder' => '', 'id' => 'labels']) }}
                </div>
                <div class="mt-2">
                    {{ Form::submit(__('layout.button.update'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
@endsection

@extends('layouts.main')

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">Создать задачу</h1>
            {{ Form::model($task, ['url' => route('tasks.store'), 'class' => 'w-50']) }}
            <div class="flex flex-col">
                <div>
                    {{ Form::label('name', __('Имя')) }}
                </div>
                <div class="mt-2">
                    {{ Form::text('name') }}
                </div>
                <div class="mt-2">
                    {{ Form::label('description', __('Описание')) }}
                </div>
                <div>
                    {{ Form::textarea('description') }}
                </div>
                <div class="mt-2">
                    {{ Form::label('status_id', __('Статус')) }}
                </div>
                <div>
                    {{ Form::select('status_id', $statuses, null, ['class' => 'form-control rounded border-gray-300 w-1/3', 'placeholder' => '----------']) }}
                </div>
                <div class="mt-2">
                    {{ Form::label('assigned_to_id', __('Исполнитель')) }}
                </div>
                <div>
                    {{ Form::select('assigned_to_id', $users, null, ['class' => 'form-control rounded border-gray-300 w-1/3', 'placeholder' => '----------']) }}
                </div>
                <div class="mt-2">
                    {{ Form::submit(__('Создать'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
                    <a class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded' href="{{ route('tasks.index')}}">Назад</a>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
@endsection
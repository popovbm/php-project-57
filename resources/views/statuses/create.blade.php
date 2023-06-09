@extends('layouts.main')

@section('content')
<section class="bg-white dark:bg-gray-900 text-black dark:text-white">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5 text-5xl">Создать статус</h1>
            @if ($errors->any())
            @include('components.show-form-errors')
            @endif
            {{ Form::model($taskStatus, ['url' => route('task_statuses.store'), 'class' => 'w-50']) }}
            <div class="flex flex-col">
                <div>
                    {{ Form::label('name', 'Имя') }}
                </div>
                <div class="mt-2 text-black">
                    {{ Form::text('name') }}
                </div>
                <div class="mt-2">
                    {{ Form::submit('Создать', ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>
@endsection
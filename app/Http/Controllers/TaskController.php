<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task', [
            'except' => ['index', 'show'],
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::pluck('name', 'id');
        $statuses = TaskStatus::pluck('name', 'id');
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters(
                [
                    AllowedFilter::exact('status_id'),
                    AllowedFilter::exact('created_by_id'),
                    AllowedFilter::exact('assigned_to_id')
                ]
            )
            ->orderBy('id', 'asc')
            ->paginate();

        $filter = $request->filter ?? null;

        return view('tasks.index', compact('tasks', 'statuses', 'users', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = new Task();
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        return view('tasks.create', compact('task', 'statuses', 'users', 'labels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();

        $task = $request->user()->tasks()->create($data);

        if (isset($data['labels'])) { //проверяем выбраны ли в форме лэйблы?
            if ($data['labels'][0] === null) { // если выбрана первая опция('')
                if (count($data['labels']) > 1) { // + выбраны другие лэйблы
                    unset($data['labels'][0]); // убираем первую опцию(null)
                    $task->labels()->attach($data['labels']); // добавляем к таску оставшиеся лэйблы
                } // если кроме первой опции('') больше ничего не выбрано, просто чилим :)
            } else { // если не выбрана первая опция('')
                $task->labels()->attach($data['labels']); // добавляем к таску выбранные лэйблы
            }
        }

        session()->flash('message', 'New task created successfully');

        return redirect()
            ->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        return view('tasks.edit', compact('task', 'users', 'statuses', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $data = $request->validated();

        $task->fill($data)->save();

        if (isset($data['labels'])) { //проверяем выбраны ли в форме лэйблы?
            if ($data['labels'][0] === null && count($data['labels']) > 1) { // если выбрана первая опция('') и другие
                unset($data['labels'][0]); // убираем первую опцию(null)
                $task->labels()->sync($data['labels']); // синхронизируем
            } elseif ($data['labels'][0] === null) { // если выбрана только первая опция('')
                $task->labels()->detach(); // удаляем все лэйблы у таска
            } else { // иначе просто синхронизируем
                $task->labels()->sync($data['labels']);
            }
        } else { // если в форме не выбран ни один лэйбл
            $task->labels()->detach(); // удаляем все лэйблы у таска
        }

        session()->flash('message', 'Task edited successfully');

        return redirect()
            ->route('tasks.show', $task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $taskName = $task->name;
        $task->labels()->detach();
        $task->delete();

        session()->flash('message', "Task \"{$taskName}\" deleted successfully");

        return redirect()
            ->route('tasks.index');
    }
}

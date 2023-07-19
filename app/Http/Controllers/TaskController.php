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
            ->paginate(15);

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

        if (isset($data['labels'])) {
            if (in_array(null, $data['labels'], true)) {
                if (count($data['labels']) > 1) {
                    unset($data['labels'][array_search(null, $data['labels'], true)]);
                    $task->labels()->attach($data['labels']);
                }
            } else {
                $task->labels()->attach($data['labels']);
            }
        }

        session()->flash('success', __('layout.task.flash_create_success'));

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

        if (isset($data['labels'])) {
            if (in_array(null, $data['labels'], false)) {
                if (count($data['labels']) > 1) {
                    unset($data['labels'][array_search(null, $data['labels'], false)]);
                    $task->labels()->sync($data['labels']);
                } else {
                    $task->labels()->detach();
                }
            } else {
                $task->labels()->sync($data['labels']);
            }
        }

        session()->flash('success', __('layout.task.flash_update_success'));

        return redirect()
            ->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->labels()->detach();
        $task->delete();

        session()->flash('success', __('layout.task.flash_delete_success'));

        return redirect()
            ->route('tasks.index');
    }
}

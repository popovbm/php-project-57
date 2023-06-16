<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;

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
    public function index()
    {
        $tasks = Task::orderBy('id', 'asc')->paginate();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = new Task();
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        return view('tasks.create', compact('task', 'statuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();

        $request->user()->tasks()->make($data)->save();

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
        return view('tasks.edit', compact('task', 'users', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $data = $request->validated();

        $task->fill($data)->save();

        session()->flash('message', 'Task edited successfully');

        return redirect()
            ->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $taskName = $task->name;
        $task->delete();

        session()->flash('message', "Task \"{$taskName}\" deleted successfully");

        return redirect()
            ->route('tasks.index');
    }
}

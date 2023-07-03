<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class, 'task_status', [
            'except' => ['index'],
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskStatuses = TaskStatus::orderBy('id', 'asc')->paginate();

        return view('statuses.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $taskStatus = new TaskStatus();
        return view('statuses.create', compact('taskStatus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskStatusRequest $request)
    {
        $data = $request->validated();

        $taskStatus = new TaskStatus($data);
        $taskStatus->save();

        session()->flash('success', "New status created successfully");

        return redirect()
            ->route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $taskStatus)
    {
        return view('statuses.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskStatusRequest $request, TaskStatus $taskStatus)
    {
        $data = $request->validated();

        $taskStatus->fill($data)->save();

        session()->flash('success', "Status edited successfully");

        return redirect()
            ->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        if (!empty($taskStatus->tasks()->first())) {
            session()->flash('error', "Не удалось удалить статус");
            return back();
        }
        $taskStatus->delete();

        session()->flash('success', "Status deleted successfully");

        return redirect()
            ->route('task_statuses.index');
    }
}

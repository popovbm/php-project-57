<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskStatusController extends Controller
{
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
        if (Auth::user()) {
            $taskStatus = new TaskStatus();
            return view('statuses.create', compact('taskStatus'));
        } else {
            return abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskStatusRequest $request)
    {
        if (Auth::user()) {
            $data = $request->validated();

            $newStatus = new TaskStatus();
            $newStatus->fill($data);
            $newStatus->save();

            session()->flash('message', 'New status created successfully');

            return redirect()
                ->route('task_statuses.index');
        } else {
            return abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskStatus $taskStatus)
    {
        //
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
        if (Auth::user()) {
            $data = $request->validated();

            $taskStatus->fill($data);
            $taskStatus->save();

            session()->flash('message', 'Status edited successfully');

            return redirect()
                ->route('task_statuses.index');
        } else {
            return abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        if (Auth::user()) {
            $taskStatusName = $taskStatus->name;
            $taskStatus->delete();

            session()->flash('message', "Status \"{$taskStatusName}\" deleted successfully");

            return redirect()
                ->route('task_statuses.index');
        } else {
            return abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }
    }
}

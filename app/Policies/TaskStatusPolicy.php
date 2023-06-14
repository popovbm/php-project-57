<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class TaskStatusPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TaskStatus $taskStatus): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TaskStatus $taskStatus): bool
    {
        return Auth::check() && $user->id === $taskStatus->creator_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TaskStatus $taskStatus): bool
    {
        return Auth::check() && $user->id === $taskStatus->creator_id && empty(Task::firstWhere('status_id', $taskStatus->id));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TaskStatus $taskStatus): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TaskStatus $taskStatus): bool
    {
        //
    }

    public function seeActions(User $user): bool
    {
        return Auth::check();
    }
}

<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    // المستخدم ينجم يعدل كان المهام متاعو
    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    // المستخدم ينجم يحذف كان المهام متاعو
    public function delete(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}

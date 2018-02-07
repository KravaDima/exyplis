<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // разрешение редактирования задачи только пользователю, который её создал
    public function edit(User $user, $task)
    {
        if($user->id == $task->user_id) {
            return true;
        }
        return false;
    }

    // разрешение удаления задачи только пользователю, который её создал
    public function del(User $user, $task)
    {
        if($user->id == $task->user_id) {
            return true;
        }
        return false;
    }
}

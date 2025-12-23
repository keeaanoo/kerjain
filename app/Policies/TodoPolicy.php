<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;

// AUTHENTICATION: Policy for authorization - ensures users can only access their own todos
class TodoPolicy
{
    public function view(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }

    public function update(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }

    public function delete(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }
}

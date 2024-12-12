<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class AccessPolicy
{


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->role == 'admin';
    }

 }

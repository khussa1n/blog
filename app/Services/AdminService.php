<?php

namespace App\Services;

use App\Models\Article;
use App\Models\User;

class AdminService
{
    public function getUserRolesAndPermissions($user)
    {
        if ($user->roles()->exists()) {
            $userRoles = $user->roles()->pluck('name')->toArray();
            $userPermissions = $user->permissions()->pluck('name')->toArray();
        } else {
            $userRoles = [];
            $userPermissions = [];
        }

        return compact('userRoles', 'userPermissions');
    }
}

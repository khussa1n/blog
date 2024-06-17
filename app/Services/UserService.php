<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data): User
    {
        return User::create([
            'full_name' => $data['full_name'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function login(array $credentials): bool
    {
        return Auth::guard('web')->attempt($credentials);
    }

    public function logout(): void
    {
        Auth::guard('web')->logout();
    }

    public function getUsers($perPage)
    {
        $query = User::query();
        $totalItems = $query->count();
        $users = $query
            ->orderBy('updated_at', 'desc')
            ->withCount('articles')
            ->paginate($perPage);
        $users->load('roles');

        return compact('users', 'totalItems');
    }
}

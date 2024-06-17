<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function join()
    {
        return view('auth.join');
    }

    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function joinStore(Request $request)
    {
        $request->validate([
            'full_name' => ['required', 'string', 'max:255', 'min:3'],
            'nickname' => ['required', 'string', 'max:255', 'min:3', 'unique:users'],
            'email' => 'required|email|unique:users',
            'password' => ['required', 'min:8', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'full_name' => $request->full_name,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        auth()->login($user);

        return to_route('articles.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|string',
        ]);

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect()->intended(route('articles.index'));
        }
        else
        {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('articles.index');
    }

    public function profile(string $nickname)
    {
        $perPage = request()->input('per_page', 10);

        $user = User::where('nickname', $nickname)->firstOrFail();

        $query = Article::query()->where('user_id', $user->id);

        $countQuery = clone $query;

        if (!auth()->check())
        {
            $articles = $query
                ->where('status', 'published')
                ->orderBy('updated_at', 'desc')
                ->paginate($perPage);

            $totalItems = $countQuery->where('status', 'published')->count();
        }
        else if (auth()->user()->nickname == $nickname || auth()->user()->hasRole('admin')
            || auth()->user()->hasRole('moderator'))
        {
            $articles = $query
                ->orderBy('updated_at', 'desc')
                ->paginate($perPage);

            $totalItems = $countQuery->count();
        }

        $role = $user->roles->first()->name ?? 'Пользователь';

        return view('profile.profile', compact('user', 'articles', 'role', 'totalItems'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\LoginUserRequest;
use App\Models\User;
use App\Services\UserService;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;
    protected $articleService;

    public function __construct(UserService $userService, ArticleService $articleService)
    {
        $this->userService = $userService;
        $this->articleService = $articleService;
    }

    /**
     * Display the join form.
     */
    public function join()
    {
        return view('auth.join');
    }

    /**
     * Display the login form.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created user in storage.
     */
    public function joinStore(CreateUserRequest $request)
    {
        $user = $this->userService->createUser($request->only(['full_name', 'nickname', 'email', 'password']));
        Auth::login($user);

        return redirect()->route('articles.index');
    }

    /**
     * Handle user login.
     */
    public function loginStore(LoginUserRequest $request)
    {
        if ($this->userService->login($request->only('email', 'password'))) {
            return redirect()->intended(route('articles.index'));
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        $this->userService->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('articles.index');
    }

    /**
     * Display user profile.
     */
    public function profile(string $nickname)
    {
        $perPage = request()->input('per_page', 10);
        $user = User::where('nickname', $nickname)->firstOrFail();
        $authUser = auth()->user();

        if (!$authUser) {
            $articles = $this->articleService->getUserArticles($user, 'published', $perPage);
            $totalItems = $this->articleService->countUserArticles($user, 'published');
        } else if ($authUser->nickname == $nickname || $authUser->hasRole('admin') || $authUser->hasRole('moderator')) {
            $articles = $this->articleService->getUserArticles($user, null, $perPage);
            $totalItems = $this->articleService->countUserArticles($user, null);
        }

        $role = $user->roles->first()->name ?? 'Пользователь';

        return view('profile.profile', compact('user', 'articles', 'role', 'totalItems'));
    }
}


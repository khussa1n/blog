<header class="fixed z-50 w-full p-4 bg-white shadow">
    <nav class="w-[1000px] mx-auto flex justify-between items-center">
        <x-includes.category-list />
        @guest
            <ul class="flex space-x-4 text-white">
                <li>
                    <a href="{{ route('login') }}"
                       class="text-sm px-3 py-2 bg-cyan-600 hover:bg-cyan-700 rounded">
                        Войти
                    </a>
                </li>
            </ul>
        @endguest
        @auth
            <a href="{{ route('profile', ['nickname' => auth()->user()->nickname]) }}" class="text-sm text-neutral-700 hover:text-cyan-600">@<span>{{ auth()->user()->nickname }}</span></a>
        @endauth
    </nav>
</header>

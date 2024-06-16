<div class="fixed z-50 w-[18rem] bg-white py-2 text-sm shadow text-neutral-600" style="margin-left: calc(1000px - 18rem);">
    @auth
        <ul class="flex flex-col">
            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('moderator'))
                <li>
                    <a href="{{ route('admin.index') }}" class="w-full flex px-6 py-3 hover:bg-sky-100 hover:text-cyan-600">
                        Админ панель
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('articles.create') }}" class="w-full flex px-6 py-3 hover:bg-sky-100 hover:text-cyan-600">
                    Написать статью
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full flex px-6 py-3 hover:bg-sky-100 hover:text-cyan-600" type="submit">Выход</button>
                </form>
            </li>
        </ul>
    @endauth
    @guest
        <ul class="flex flex-col">
            <li>
                <a href="{{ route('join') }}" class="w-full flex px-6 py-3 hover:bg-sky-100 hover:text-cyan-600">
                    Стать автором
                </a>
            </li>
        </ul>
    @endguest
</div>


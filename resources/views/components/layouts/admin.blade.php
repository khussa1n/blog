<div class="min-h-screen flex flex-col justify-between">
    <header class="fixed z-50 w-full p-4 bg-white shadow">
        <nav class="w-[1200px] mx-auto flex justify-between items-center text-sm text-neutral-700">
            <a href="{{ route('admin.index') }}" class="block hover:text-cyan-700 text-xl">Административная панель</a>
            <div class="flex gap-5">
                <a href="{{ route('admin.articles.index') }}" class="block hover:text-cyan-700">Статьи</a>
                <a href="{{ route('admin.users.index') }}" class="block hover:text-cyan-700">Пользователи</a>
                <a href="{{ route('articles.index') }}" class="block hover:text-cyan-700">Вернуться в главную</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="hover:text-cyan-700" type="submit">Выход</button>
                </form>
            </div>
        </nav>
    </header>
    <div class="w-[1200px] mx-auto pt-[5rem] flex">
        <div class="w-full">
            {{ $slot }}
        </div>
    </div>
    <x-includes.footer />
</div>

<x-layouts.layout>
    <x-layouts.content>
        <div class="w-full bg-white shadow p-5 text-neutral-600">
            <div class="flex flex-col gap-2">
                <div class="flex gap-3">
                    <label class="text-neutral-500">Имя:</label>
                    <span class="text-cyan-700">{{ $user->full_name }}</span>
                </div>
                <div class="flex gap-3">
                    <label class="text-neutral-500">Никнейм:</label>
                    <span class="text-cyan-700"><span>@</span>{{ $user->nickname }}</span>
                </div>
                <div class="flex gap-3">
                    <label class="text-neutral-500">E-mail:</label>
                    <span class="text-cyan-700">{{ $user->email }}</span>
                </div>
                <div class="flex gap-3">
                    <label class="text-neutral-500">Роль:</label>
                    <span>{{ $role != null ? $role : 'Пользователь' }}</span>
                </div>
            </div>
            <div class="mt-10">
                @if (auth()->check() && (auth()->user()->nickname == $user->nickname))
                    <h2>Мои статьи</h2>
                @else
                    <h2>Cтатьи</h2>
                @endif
                <div class="border-b mt-3"></div>
                <ul class="space-y-4 mt-4">
                    @foreach($articles as $article)
                        <div class="w-full flex flex-col gap-1 py-3 border-b">
                            <div>
                                @auth
                                    <div>status: <span class="text-gray-500">{{ $article->status }}</span></div>
                                @endauth
                                <span class="text-gray-500 text-xs">{{ $article->created_at->translatedFormat('j M \в H:i') }}</span>
                            </div>
                            <a href="{{ route('articles.show', ['article' => $article]) }}" class="w-fit text-xl mt-2 hover:text-cyan-600">{{ $article->title }}</a>
                            <div class="w-full flex justify-between text-sm mt-1">
                                <span class="text-gray-500">{{ $article->category->name }}</span>
                                <div class="flex gap-2">
                                    @can('update', $article)
                                        <a href="{{ route('articles.edit', ['article' => $article]) }}" class="text-gray-600 hover:text-cyan-700">Редактировать</a>
                                    @endcan
                                    @if($article->status == 'published')
                                        @can('archive', $article)
                                            <form action="{{ route('articles.archive', $article) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-gray-600 hover:text-cyan-700">Архивировать</button>
                                            </form>
                                        @endcan
                                    @else
                                        @can('publish', $article)
                                            <form action="{{ route('articles.publish', $article) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-gray-600 hover:text-cyan-700">Опубликовать</button>
                                            </form>
                                        @endcan
                                        @can('forceDelete', $article)
                                            <form action="{{ route('articles.destroy', ['article' => $article]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-600 hover:text-cyan-700">Удалить</button>
                                            </form>
                                        @endcan
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
        <x-includes.pagination :items="$articles" />
    </x-layouts.content>
</x-layouts.layout>

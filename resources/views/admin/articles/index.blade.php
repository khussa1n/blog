<x-layouts.layout>
    <x-layouts.admin>
        <div class="relative overflow-x-auto shadow">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            user
                        </th>
                        <th scope="col" class="px-6 py-3">
                            title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            created
                        </th>
                        <th scope="col" class="px-6 py-3">
                            actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <td class="px-6 py-4">
                                <a href="{{ route('profile', ['nickname' => $article->user->nickname]) }}" class="hover:text-cyan-600">{{ $article->user->nickname }}</a>
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap overflow-ellipsis overflow-hidden max-w-80">
                                <a href="{{ route('articles.show', ['article' => $article]) }}" class="hover:text-cyan-600">{{ $article->title }}</a>
                            </th>
                            <td class="px-6 py-4">
                                {{ $article->category->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $article->status }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $article->created_at->translatedFormat('j M \в H:i') }}
                            </td>
                            <td class="px-6 py-4 flex gap-2">
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-includes.pagination :items="$articles" />
    </x-layouts.admin>
</x-layouts.layout>

<?php

$segment2 = request()->segment(2);

?>

<div class="flex flex-col gap-3 pt-3 pb-7 px-4 bg-white shadow" style="width: calc(1000px - 18.9rem);">
    <div class="flex justify-between">
        <div class="flex gap-3 text-sm">
            <a href="{{ route('profile', ['nickname' => $article->user->nickname]) }}" class="font-medium hover:text-cyan-600 text-neutral-600">{{ $article->user->nickname }}</a>
            <span class="text-gray-500">{{ $article->created_at->translatedFormat('j M \в H:i') }}</span>
            @if ($segment2 == $article->id)
                @can('showStatus', $article)
                    <span class="text-gray-500">{{ $article->status }}</span>
                @endcan
            @endif
        </div>
        @if ($segment2 == $article->id)
            <div class="flex gap-2 text-sm">
                @can('update', $article)
                    <a href="{{ route('articles.edit', ['article' => $article]) }}" class="text-cyan-600 hover:text-cyan-700">Редактировать</a>
                @endcan
                @if($article->status == 'published')
                    @can('archive', $article)
                        <form action="{{ route('articles.archive', $article) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-cyan-600 hover:text-cyan-700">Архивировать</button>
                        </form>
                    @endcan
                @else
                    @can('publish', $article)
                        <form action="{{ route('articles.publish', $article) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-cyan-600 hover:text-cyan-700">Опубликовать</button>
                        </form>
                    @endcan
                    @can('forceDelete', $article)
                        <form action="{{ route('articles.destroy', ['article' => $article]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-cyan-600 hover:text-cyan-700">Удалить</button>
                        </form>
                    @endcan
                @endif
            </div>
        @endif
    </div>
    @if ($segment2 == $article->id)
        <h3 class="text-2xl mt-2">{{ $article->title }}</h3>
    @else
        <a href="{{ route('articles.show', ['article' => $article]) }}" class="text-2xl mt-2 hover:text-cyan-600">{{ $article->title }}</a>
    @endif
    <span class="text-sm text-gray-500">{{ $article->category->name }}</span>
    @if ($article->image_blob && $article->image_mime)
        <img src="data:{{ $article->image_mime }};base64,{{ $article->image_blob }}" alt="Изображение статьи" class="">
    @endif
    @if ($segment2 == $article->id)
        <p class="text-gray-700 mt-2">{{ $article->content }}</p>
    @else
        <p class="text-gray-700 mt-2">{{ $article->excerpt }}</p>
        <a href="{{ route('articles.show', ['article' => $article]) }}" class="block w-fit px-4 py-2.5 mt-5 text-xs border border-cyan-600 hover:bg-cyan-600 text-cyan-600 hover:text-white rounded transition-colors duration-150">
            Читать далее
        </a>
    @endif
</div>



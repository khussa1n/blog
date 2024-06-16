<?php

use App\Http\Controllers\CategoryController;

$categories = app(CategoryController::class)->getCategories();

$currentSlug = request()->segment(1);
$segment2 = request()->segment(2);

?>

<ul class="flex space-x-4">
    <li>
        <a href="{{ route('articles.index') }}"
           class="text-neutral-500 hover:text-cyan-600 text-sm {{ $currentSlug === 'articles' && $segment2 === null ? 'text-neutral-900' : '' }}">
            Все потоки
        </a>
    </li>
    @foreach ($categories as $category)
        <li>
            <a href="/{{ $category->slug . '/articles' }}"
               class="text-neutral-500 hover:text-cyan-600 text-sm {{ $category->slug === $currentSlug ? 'text-neutral-900' : '' }}">
                {{ $category->name }}
            </a>
        </li>
    @endforeach
</ul>

<x-layouts.layout>
    <x-layouts.content>
        <div class="w-full bg-white shadow p-5 text-neutral-800 space-y-5">
            <h1 class="text-xl font-medium">Создание статьи</h1>
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Заголовок</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-cyan-500 focus:ring focus:ring-cyan-200 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="excerpt" class="block text-sm font-medium text-gray-700">Краткое описание</label>
                    <input type="text" name="excerpt" id="excerpt" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-cyan-500 focus:ring focus:ring-cyan-200 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="body" class="block text-sm font-medium text-gray-700">Содержание</label>
                    <textarea name="body" id="body" rows="5" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-cyan-500 focus:ring focus:ring-cyan-200 focus:ring-opacity-50" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Категория</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full bg-white px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-cyan-500 focus:ring focus:ring-cyan-200 focus:ring-opacity-50" required>
                        <option value="">Выберите категорию</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Изображение</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full">
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Статус</label>
                    <select name="status" id="status" class="mt-1 block w-full bg-white px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-cyan-500 focus:ring focus:ring-cyan-200 focus:ring-opacity-50" required>
                        <option value="draft">Черновик</option>
                        <option value="published">Опубликовано</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-cyan-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-700 active:bg-cyan-700 focus:outline-none focus:border-cyan-700 focus:ring focus:ring-cyan-200 disabled:opacity-25 transition">Сохранить</button>
                </div>
            </form>
        </div>
    </x-layouts.content>
</x-layouts.layout>

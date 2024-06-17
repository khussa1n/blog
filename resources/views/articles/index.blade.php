<x-layouts.layout>
    <x-layouts.content>
        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if($articles->isEmpty())
            <div class="w-full p-4 bg-white shadow-md">
                <p>Статьи не найдены.</p>
            </div>
        @else
            <ul class="space-y-4">
                @foreach($articles as $article)
                    <x-includes.article :article="$article"/>
                @endforeach
            </ul>
        @endif
        <x-includes.pagination :items="$articles" :totalItems="$totalItems" />
    </x-layouts.content>
</x-layouts.layout>

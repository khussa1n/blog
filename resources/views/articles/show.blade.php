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

        <x-includes.article :article="$article"/>
    </x-layouts.content>
</x-layouts.layout>

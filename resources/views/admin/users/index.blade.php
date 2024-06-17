<x-layouts.layout>
    <x-layouts.admin>
        <div class="relative overflow-x-auto shadow">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        никнейм
                    </th>
                    <th scope="col" class="px-6 py-3">
                        полное имя
                    </th>
                    <th scope="col" class="px-6 py-3">
                        email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        создано
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Статьи
                    </th>
                    <th scope="col" class="">
                        роли
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4">
                            {{ $user->id }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap overflow-ellipsis overflow-hidden max-w-80">
                            <a href="{{ route('profile', ['nickname' => $user->nickname]) }}" class="hover:text-cyan-600">{{ $user->nickname }}</a>
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->full_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->created_at->translatedFormat('j M \в H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->articles_count }}
                        </td>
                        <td>
                            @foreach ($user->roles as $role)
                                {{ $role->name }}
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <x-includes.pagination :items="$users" :totalItems="$totalItems" />
    </x-layouts.admin>
</x-layouts.layout>

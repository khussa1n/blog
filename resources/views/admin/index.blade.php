<x-layouts.layout>
    <x-layouts.admin>
        <div class="text-neutral-700">
            <div class="flex flex-col gap-4 p-4 bg-white shadow-md">
                <h2 class="text-xl font-medium mb-4">Dashboard</h2>

                <div class="flex items-end gap-3">
                    <h2 class="text-lg">Ваши роли: </h2>
                    <div class="flex gap-2">
                        @foreach($userRoles as $userRole)
                            <span>
                                {{ $userRole }}
                            </span>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-end gap-3">
                    <h2 class="text-lg">Вы можете: </h2>
                    <div class="flex gap-2">
                        @foreach($userPermissions as $userPermission)
                            <span>
                                {{ $userPermission }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.admin>
</x-layouts.layout>

@if($totalItems > 5)
    <div class="w-fit mx-auto h-fit mt-5 bg-white py-2 px-3 shadow flex gap-3 items-center justify-center">
        @if ($items->onFirstPage())
            <span class="px-3 py-1 bg-gray-200 text-gray-600">Предыдущий</span>
        @else
            <a href="{{ $items->appends(request()->query())->previousPageUrl() }}" class="px-3 py-1 bg-cyan-500 text-white">Предыдущий</a>
        @endif

        <ul class="flex items-center">
            @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                @if ($page == $items->currentPage())
                    <li class="px-3 py-1 bg-cyan-500 text-white">{{ $page }}</li>
                @else
                    <li>
                        <a href="{{ $url }}&per_page={{ request()->input('per_page', 10) }}" class="block px-3 py-1 bg-gray-200 hover:text-cyan-500 text-gray-600 ">{{ $page }}</a>
                    </li>
                @endif
            @endforeach
        </ul>

        @if ($items->hasMorePages())
            <a href="{{ $items->appends(request()->query())->nextPageUrl() }}" class="px-3 py-1 bg-cyan-500 text-white">Следующий</a>
        @else
            <span class="px-3 py-1 bg-gray-200 text-gray-600">Следующий</span>
        @endif

        <select name="per_page" id="per_page" class="px-2 py-1.5 outline-0">
            <option value="5" {{ request()->input('per_page') == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request()->input('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ request()->input('per_page') == 20 ? 'selected' : '' }}>20</option>
            <option value="50" {{ request()->input('per_page') == 50 ? 'selected' : '' }}>50</option>
        </select>
    </div>

    <script>
        document.getElementById('per_page').addEventListener('change', function() {
            const perPage = this.value;
            const currentUrl = window.location.href.split('?')[0];
            const newUrl = currentUrl + '?per_page=' + perPage;
            window.location.href = newUrl;
        });
    </script>
@endif

<div class="min-h-screen flex flex-col justify-between">
    <x-includes.header />
    <div class="w-[1000px] mx-auto pt-[4.3rem] flex">
        <div style="width: calc(1000px - 18.9rem);">
            {{ $slot }}
        </div>
        <x-includes.sidebar />
    </div>
    <x-includes.footer />
</div>

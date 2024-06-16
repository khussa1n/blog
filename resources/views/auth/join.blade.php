<x-layouts.layout>
    <div class="max-w-screen min-h-screen py-5 flex items-center justify-center">
        <div>
            <form method="POST" action="{{ route('join.store') }}" class="bg-white w-[26rem] h-fit p-10 flex flex-col gap-5 text-sm shadow-md">
                @csrf
                <h1 class="text-2xl mb-5">Регистрация</h1>
                <div class="flex flex-col gap-2">
                    <label for="email" class="">
                        E-mail
                    </label>
                    <input required type="email" id="email" name="email" class="outline-0 px-4 py-2 w-full border border-gray-300 focus:border-blue-400" />
                    @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col gap-2">
                    <label for="nickname" class="">
                        Никнейм
                    </label>
                    <input required type="text" id="nickname" name="nickname" class="outline-0 px-4 py-2 w-full border border-gray-300 focus:border-blue-400" />
                    @error('nickname')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col gap-2">
                    <label for="full_name" class="">
                        Полное имя
                    </label>
                    <input required type="text" id="full_name" name="full_name" class="outline-0 px-4 py-2 w-full border border-gray-300 focus:border-blue-400" />
                    @error('full_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password" class="">
                        Пароль
                    </label>
                    <input required type="password" id="password" name="password" class="outline-0 px-4 py-2 w-full border border-gray-300 focus:border-blue-400" />
                    @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password_confirmation" class="">
                        Пароль еще раз
                    </label>
                    <input required type="password" id="password_confirmation" name="password_confirmation" class="outline-0 px-4 py-2 w-full border border-gray-300 focus:border-blue-400" />
                    @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="px-4 mt-4 py-2 w-full bg-cyan-600 text-white">
                    Зарегистрироваться
                </button>
            </form>
            <div class="w-[26rem] h-fit p-4 mt-4 bg-white text-sm shadow-md">
                <p class="text-center text-gray-700">Уже зарегистрированы? <a href="{{ route('login') }}" class="text-cyan-600">Войдите</a></p>
            </div>
        </div>
    </div>
</x-layouts.layout>

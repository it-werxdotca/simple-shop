<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/" class="text-4xl">
                <span class="text-white">Simpl</span><span class="text-red-600">@</span>
            </a>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label value="Email" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label value="Password" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4 flex justify-between">
                <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="justify-center w-full">
                    {{ __('Login') }}
                </x-jet-button>
            </div>

            <div class="grid grid-cols-1 items-center mt-4">
                <div class="text-center mb-4">No account yet?</div>
                <a
                    class="
                        text-center px-4 py-2 bg-blue-600 border hover:bg-blue-400
                        border-transparent rounded-md font-semibold text-xs
                        text-white uppercase w-full
                    "
                    href="{{ route('register') }}"
                >
                    {{ __('Sign up') }}
                </a>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

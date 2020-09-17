<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/" class="text-4xl">
                <span class="text-white">Simpl</span><span class="text-red-600">@</span>
            </a>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label value="Name" />
                <x-jet-input class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label value="Email" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label value="Password" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label value="Confirm Password" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-button class="w-full justify-center">
                    {{ __('Register') }}
                </x-jet-button>
            </div>

            <div class="grid grid-cols-1 items-center mt-4">
                <div class="text-center mb-4">{{__('Already registered?')}}</div>
                <a
                        class="
                        text-center px-4 py-2 bg-blue-600 border hover:bg-blue-400
                        border-transparent rounded-md font-semibold text-xs
                        text-white uppercase w-full
                    "
                        href="{{ route('login') }}"
                >
                    {{ __('Login') }}
                </a>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

<x-guest-layout>
    <h2 class="text-center mb-5 text-3xl dark:text-white"><a href="/">{{ __('layout.name') }}</a></h2>

    <div class="mb-4 text-sm text-gray-600 dark:text-white">
        {{ __('layout.profile.forgot_text') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('layout.profile.email')" class="dark:text-white" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4">
                {{ __('layout.profile.reset_button') }}
            </button>
        </div>
    </form>
</x-guest-layout>

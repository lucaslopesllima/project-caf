<x-guest-layout>
    <div class="flex flex-col content-center 2">
        <x-application-logo/>
        <div class="mb-4 text-base-conten">
            <h1>{{ __('Forgot your password?') }}</h2>
            <p>{{ __('No problems, Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label class="flex items-center gap-2 input input-bordered"> 
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></g></svg>
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </label>
            </div>

            <div class="flex flex-row justify-center pt-4">
                <x-primary-button class="flex w-full space-x-2 bg-sky-500/30 btn btn-wide">
                    {{ __('Password Reset') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>

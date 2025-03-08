<x-guest-layout>
    <div class="flex flex-col content-center 2">
        <x-application-logo />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label class="flex items-center gap-2 input input-bordered">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="w-4 h-4 opacity-70">
                        <path
                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
                    </svg>
                    <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" placeholder="Email" oninput="validateLogin()" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </label>
            </div>
            <div class="mt-4">
                <label class="flex items-center gap-2 input input-bordered">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="w-4 h-4 opacity-70">
                        <path fill-rule="evenodd"
                            d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                            clip-rule="evenodd" />
                    </svg>
                    <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                        autocomplete="current-password" placeholder="Senha" oninput="validateLogin()" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </label>
            </div>
            <div class="flex flex-row content-center justify-between mt-4">
                <div class="flex flex-row content-center justify-between">
                    <input id="remember_me" type="checkbox" class="checkbox checkbox-info" name="remember" disabled>
                    <span class="ms-2 text-bg">{{ __('Remember me') }}</span>
                </div>
                <div class="flex flex-row content-center justify-between">
                    <label for="remember_me" class="cursor-pointer">
                        @if (Route::has('password.request'))
                            <a class="flex link link-info" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </label>
                </div>
            </div>

            <div class="flex pt-8 space-x-20">
                <x-primary-button class="flex w-full space-x-2 bg-sky-500/30 btn btn-wide">
                    {{ __('Login') }}
                </x-primary-button>
            </div>
            <div class="flex flex-row justify-center pt-4">
                <a class="link link-hover" href="{{ route('register') }}">
                    {{ __('Create Account') }}
                </a>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/login.js') }}"></script>
</x-guest-layout>

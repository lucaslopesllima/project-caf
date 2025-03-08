<x-guest-layout>
   
    <div class="flex flex-col content-center 2">
        <x-application-logo />
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            
            <div>
                <label class="flex items-center gap-2 input input-bordered">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="w-4 h-4 opacity-70">
                    <path
                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
                    </svg>
                  <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="{{ __('Name') }}"/>
                  <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </label>
            </div>


            <div class="mt-4">
                <label class="flex items-center gap-2 input input-bordered">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></g></svg>
                    <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="{{ __('Email') }}"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </label>
            </div>

            
            <div class="mt-4">
                <label class="flex items-center gap-2 input input-bordered">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><path d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"></path><circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle></g></svg>    
                    <x-text-input id="password" class="block w-full mt-1"
                                type="password"
                                name="password"
                                required autocomplete="new-password"
                                placeholder="{{ __('Password') }}"/>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </label>
            </div>

            
            <div class="mt-4">
                <label class="flex items-center gap-2 input input-bordered">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><path d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"></path><circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle></g></svg>    
                    <x-text-input id="password_confirmation" class="block w-full mt-1"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}"/>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </label>
            </div>

            <div class="mt-4">
                <label class="flex items-center gap-2 input input-bordered">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><path d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"></path><circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle></g></svg>    
                    <input type="file" name="image">
                </label>
            </div>

            @auth
            <div class="flex justify-center  mt-8">
                <x-primary-button class="btn btn-primary text-white bg-blue-500">
                    Salvar
                </x-primary-button>
                <a class="btn btn-sencondary" href="{{route('dashboard')}}">Voltar</a>
            </div>
            @endauth
            @guest
            <div class="flex pt-8 space-x-20">
                <x-primary-button class="flex w-full space-x-2 bg-sky-500/30 btn btn-wide">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
            
            <div class="flex flex-row justify-center pt-4">
                <a cclass="link link-hover" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
            @endguest
        </form>
    </div>
</x-guest-layout>

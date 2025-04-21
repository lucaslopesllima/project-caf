<x-app-layout>
    <x-backward-button href="{{ route('profile.index') }}"></x-backward-button>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Criando um novo perfil de usuário
            </h2>
            <form method="post" action="{{ route('profile.store') }}" class="mt-6 space-y-6">
                @csrf
                @method('POST')
                @include('profile.partials.form')
                @include('profile.partials.password-form')
                <div class="flex items-center justify-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

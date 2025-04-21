<x-app-layout>
    <x-backward-button href="{{ route('pessoa.index') }}"></x-backward-button>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <section class="d-flex justify-center align-center">
                <header class="d-flex justify-center align-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Add new beneficiary') }}
                    </h2>
                </header>
                <form method="post" action="{{ route('pessoa.store') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('post')
                    @include('people.partials.form')
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-backward-button href="{{ route('pergunta.index') }}"></x-backward-button>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <section class="d-flex justify-center align-center">
                <header class="d-flex justify-center align-center">
                    <h2 class="text-lg font-medium  text-base-content">
                        {{ __('Add new question') }}
                    </h2>
                </header>
                <form method="post" action="{{ route('pergunta.store') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('post')
                    @include('question.partials.form')
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
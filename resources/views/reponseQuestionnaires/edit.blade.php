<x-app-layout>
    <x-backward-button href="{{ route('questionario.index') }}"></x-backward-button>
    <section class="d-flex justify-center align-center">
    <header class="d-flex justify-center align-center">
            <h2 class="text-lg font-medium  text-base-content">
                {{ __('Update the questionnaire') }}
            </h2>
    </header>
    <form method="post" action="{{ route('questionario.update',['questionario']) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        @include('questionnaire.partials.form')
    </form>
</section>
</x-app-layout>

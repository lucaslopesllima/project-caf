<x-app-layout>
    <x-backward-button href="{{ route('pergunta.index') }}"></x-backward-button>
    <section class="d-flex justify-center align-center">
    <header class="d-flex justify-center align-center">
            <h2 class="text-lg font-medium  text-base-content">
                {{ __('Update the question') }}
            </h2>
    </header>
    <form method="post" action="{{ route('pergunta.update',['perguntum'=>$perguntum]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        @include('question.partials.form')
    </form>
</section>
</x-app-layout>

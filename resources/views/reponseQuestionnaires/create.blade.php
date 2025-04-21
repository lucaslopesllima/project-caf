<x-app-layout>
    <x-backward-button href="{{ route('pessoa-questionario.index') }}"></x-backward-button>
    <h2 class="text-lg font-medium text-base-content font-semibold text-xl leading-tight ms-7">
        Responda o questionario
    </h2>
    <div class="max-w-7xl sm:px-6 lg:px-8 space-y-6">
       <form method="post" action="{{ route('pessoa-questionario.store') }}" class="mt-6 space-y-6">
           @csrf
           @method('post')
           @include('reponseQuestionnaires.partials.form')
       </form>
    </div>
</x-app-layout>
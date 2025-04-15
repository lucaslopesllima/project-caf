<x-app-layout>
    <x-backward-button href="{{ route('solved_questionnairies') }}"></x-backward-button>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <section class="d-flex justify-center align-center">
                <header class="d-flex justify-center align-center">
                    <h2 class="text-lg font-medium text-base-content">
                        {{ __('Update the answers') }}
                    </h2>
                </header>
                <form method="post" action="{{ route('pessoa-questionario.update', $pessoaQuestionario->id) }}" class="mt-6 space-y-6 maax-h-40 overflow-y-auto ">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <p class="text-base-content">
                            <strong>{{ __('Person') }}:</strong> {{ $pessoaQuestionario->pessoa->nome }}
                        </p>
                        <p class="text-base-content">
                            <strong>{{ __('Questionnaire') }}:</strong> {{ $pessoaQuestionario->questionario->nome }}
                        </p>
                    </div>

                    <div class="overflow-y-auto h-[450px]">
                        @foreach($perguntas as $pergunta)
                                <x-input-label :value="$pergunta->texto" />
                                <x-text-input 
                                    type="text" 
                                    name="respostas[{{ $pergunta->id }}]" 
                                    class="mt-1 block w-full mb-1"
                                    :value="isset($respostas[$pergunta->id]) ? $respostas[$pergunta->id]->texto : ''"
                                    required
                                />
                        @endforeach
                    </div>

                    <div class="flex items-center justify-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </form>
            </section>
        </div>
</x-app-layout>

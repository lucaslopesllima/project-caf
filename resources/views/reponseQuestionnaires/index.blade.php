<x-app-layout>
    <main class="w-full">
        <h2 class="text-2xl font-bold ms-10 mt-10 mb-4">Consulta de Questionarios Respondidos</h2>
        <a class="btn btn-primary ms-10" href="{{ route('pessoa-questionario.create') }}">Nova Resposta</a>
        <div class="flex row mt-5 ms-10 justify-content-center items-center">
            <form action="{{ route('pessoa-questionario.index')}}" method="get" class="flex row justify-content-center items-center">
                <x-input-label for="nameQuetionnaire" class="mt-3 ms-3 mb-3">
                    Nome Questionario:&nbsp;
                    <x-text-input minleght="3" type="text" name="nameQuetionnaire" id="nameQuetionnaire" value="{{ $filters['nameQuetionnaire'] ?? old('nameQuetionnaire') }}">
                    </x-text-input>
                </x-input-label>
                <x-input-label for="ownerName" class="mt-3 ms-3 mb-3">
                    Nome Responsável:&nbsp;
                    <x-text-input minleght="3" type="text" name="ownerName" id="ownerName" value="{{ $filters['ownerName'] ?? old('ownerName') }}">
                    </x-text-input>
                </x-input-label>
                <x-secondary-button type="submit" class="ms-5 max-h-[25px]">Filtrar</x-secondary-button>
            </form>
            <form action="{{ route('pessoa-questionario.index')}}" method="get" class="flex row justify-content-center items-center">
                <x-secondary-button type="submit" class="ms-5 max-h-[25px]">Limpar Filtro</x-secondary-button>
            </form>
        </div>
        <div class="overflow-auto ms-10 me-10 max-h-[700px]">
            <table class="table w-full text-left">
                <thead>
                    <tr>
                        <th class="w-1/6 px-4 py-2">Nome Questionario</th>
                        <th class="w-1/6 px-4 py-2">Pessoa Responsável</th>
                        <th class="w-1/6 px-4 py-2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers as $questionnaire)
                        <tr class="hover:bg-gray-900/50">
                            <td class="px-4 py-2 truncate">
                                {{$questionnaire->questionnaire_name}}
                            </td>
                            <td class="px-4 py-2 truncate">
                                {{$questionnaire->person_name}}
                            </td>
                            <td class="flex">
                            <a href="#" 
                               data-url="{{ route('pessoa-questionario.answers-data', ['id' => $questionnaire->id]) }}"
                               onclick="showAnswersModal(this.dataset.url)"
                               class="btn btn-ghost btn-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </a>
                            <a href="{{ route('pessoa-questionario.edit', ['pessoa_questionario' => $questionnaire->id]) }}" class="btn btn-ghost btn-xs">Editar</a>
                                <form action="{{ route('pessoa-questionario.destroy', ['pessoa_questionario' => $questionnaire]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Tem certeza que deseja apagar?')">
                                        Apagar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex align-items-start ms-12">
            @include('paginator', ['paginator' => $answers])
        </div>
    </main>

    <div id="answersModal" class="modal">
        <div class="modal-box w-auto max-w-3xl">
            <h3 class="text-lg" id="modalTitle"></h3>
            <div id="modalContent" class="py-4 min-w-[300px] h-[300px] overflow-y-auto"></div>
            <div class="modal-action w-full flex justify-center">
                <button onclick="closeModal()" class="btn">Fechar</button>
            </div>
        </div>
    </div>

    <script>
        async function showAnswersModal(url) {
            try {
                const response = await fetch(url);
                const data = await response.json();
                
                document.getElementById('modalTitle').innerHTML = 
                    `<b>Respostas de:</b> ${data.pessoa.nome} <br> <b>Questionario:</b> ${data.questionario.nome}`;
                
                const content = data.questoes_respostas.map(item => `
                    <div class="mb-4">
                        <p class="font-semibold">${item.pergunta}</p>
                        <p class="text-base-content">${item.resposta || 'Sem resposta'}</p>
                    </div>
                `).join('');
                
                document.getElementById('modalContent').innerHTML = content;
                
                document.getElementById('answersModal').classList.add('modal-open');
            } catch (error) {
                console.error('Erro ao carregar as respostas:', error);
            }
        }

        function closeModal() {
            document.getElementById('answersModal').classList.remove('modal-open');
        }
    </script>
</x-app-layout>

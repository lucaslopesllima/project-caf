<x-app-layout>
    <main class="w-full">
        <h2 class="text-2xl font-bold ms-10 mt-5 mb-4 ">Cadastro de Questionarios</h2>
        <a class="btn btn-primary ms-10 mb-2" href="{{ route('questionario.create') }}">Cadastrar</a>
        <div class="flex row ms-10 justify-content-center items-center">
            <form action="{{ route('questionario.index')}}" method="get" class="flex row justify-content-center items-center">
                <x-input-label for="nameQuestionnaire" class="mt-3 ms-3 mb-3">
                    Nome:&nbsp;
                    <x-text-input minleght="3" type="text" name="nameQuestionnaire" id="nameQuestionnaire">
                    </x-text-input>
                </x-input-label>
                <x-secondary-button type="submit" class="ms-5 max-h-[25px]">Filtrar</x-secondary-button>
            </form>
            <form action="{{ route('questionario.index')}}" method="get" class="flex row justify-content-center items-center">
                <x-secondary-button type="submit" class="ms-5 max-h-[25px]">Limpar Filtro</x-secondary-button>
            </form>
        </div>
        <div class="overflow-auto ms-10 me-10 h-max-[600px]">
            <table class="table w-full text-left">
                <thead>
                    <tr>
                        <th class="w-1/6 px-4 py-2">Nome do questionario</th>
                        <th class="w-1/6 px-4 py-2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questionnaires as $questionnaire)
                        <tr class="hover:bg-gray-900/50">
                            <td class="px-4 py-2 truncate">
                                {{$questionnaire->nome}}
                            </td>
                            <td class="flex">
                                <a href="{{ route('questionario.edit',['questionario'=>$questionnaire->id]) }}" class="btn btn-ghost btn-xs">Editar</a>
                                <form action="{{ route('questionario.destroy', ['questionario' => $questionnaire]) }}" method="POST" style="display:inline;">
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
            @include('paginator', ['paginator' => $questionnaires])
        </div>
    </main>
</x-app-layout>

<x-app-layout>
    <main class="w-full">
        <h2 class="text-2xl font-bold ms-10 mt-10 mb-4">Cadastro de perguntas</h2>
        <a class="btn btn-primary ms-10" href="{{ route('pergunta.create') }}">Cadastrar</a>
        <div class="flex row ms-10 justify-content-center items-center">
            <form action="{{ route('pergunta.index')}}" method="get" class="flex row justify-content-center items-center">
                <x-input-label for="nameQuestion" class="mt-3 ms-3 mb-3">
                    Nome:&nbsp;
                    <x-text-input minleght="3" type="text" name="nameQuestion" id="nameQuestion">
                    </x-text-input>
                </x-input-label>
                <x-secondary-button type="submit" class="ms-5 max-h-[25px]">Filtrar</x-secondary-button>
            </form>
            <form action="{{ route('pergunta.index')}}" method="get" class="flex row justify-content-center items-center">
                <x-secondary-button type="submit" class="ms-5 max-h-[25px]">Limpar Filtro</x-secondary-button>
            </form>
        </div>
        <div class="overflow-auto ms-10 me-10">
            <table class="table w-full text-left">
                <thead>
                    <tr>
                        <th class="w-1/6 px-4 py-2">Pergunta</th>
                        <th class="w-1/6 px-4 py-2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                    <tr class="hover:bg-gray-900/50">
                        <td class="px-4 py-2 truncate">
                            {{$question->texto}}
                        </td>
                        <td class="flex">
                            <a href="{{ route('pergunta.edit',['perguntum'=>$question]) }}" class="btn btn-ghost btn-xs">Editar</a>
                            <form action="{{ route('pergunta.destroy', ['perguntum' => $question]) }}" method="POST" style="display:inline;">
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
                <tfoot>
                    <tr>
                        <td>
                            @include('paginator', ['paginator' => $questions])
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
</x-app-layout>
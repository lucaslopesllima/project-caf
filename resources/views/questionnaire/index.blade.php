<x-app-layout>
    <main class="w-full">
        <h2 class="text-2xl font-bold ms-10 mt-5 mb-4 ms-3">Cadastro de Questionarios</h2>
        <a class="btn btn-primary ms-3" href="{{ route('questionario.create') }}">Cadastrar</a>
        <div class="overflow-auto ms-10 me-10 h-max-[650px]">
            <table class="table w-full text-left">
                <thead>
                    <tr>
                        <th class="w-1/6 px-4 py-2">Pergunta</th>
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
        <div class="flex align-items-start">
            @include('paginator', ['paginator' => $questionnaires])
        </div>
    </main>
</x-app-layout>

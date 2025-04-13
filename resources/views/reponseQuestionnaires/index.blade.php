<x-app-layout>
    <main class="w-full">
        <h2 class="text-2xl font-bold ms-10 mt-10 mb-4 ms-3">Escolha um questionario</h2>
        <a class="btn btn-primary ms-3" href="{{ route('questionario.create') }}">Nova Resposta</a>
        <div class="overflow-auto ms-10 me-10">
            <table class="table w-full text-left">
                <thead>
                    <tr>
                        <th class="w-1/6 px-4 py-2">Nome Questionario</th>
                        <th class="w-1/6 px-4 py-2">Pesoa Responsável</th>
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
                <tfoot>
                    <tr>
                        <td>
                            @include('paginator', ['paginator' => $answers])
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
</x-app-layout>

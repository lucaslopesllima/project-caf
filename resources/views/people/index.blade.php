<x-app-layout>
    <main class="w-full">
        <h2 class="text-2xl font-bold ms-10 mt-10 mb-4 ms-3">Beneficiários</h2>
        <div class="overflow-auto ms-10">
            <table class="table w-full text-left">
                <thead>
                    <tr>
                        <th class="w-1/6 px-4 py-2">Nome</th>
                        <th class="w-1/12 px-4 py-2">Idade</th>
                        <th class="w-1/12 px-4 py-2">Filhos</th>
                        <th class="w-1/6 px-4 py-2">Naturalidade</th>
                        <th class="w-1/6 px-4 py-2">Bairro</th>
                        <th class="w-1/6 px-4 py-2">Escolaridade</th>
                        <th class="w-1/6 px-4 py-2">Cadastrada(o) em</th>
                        <th class="w-1/6 px-4 py-2">Última atualização</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($people as $person)
                        <tr class="hover:bg-gray-900/50">
                            <td class="px-4 py-2 truncate">
                                {{$person->nome}}
                            </td>

                            <td class="px-4 py-2">
                                {{$person->idade}}
                            </td>

                            <td class="px-4 py-2">
                                {{$person->quantidade_filhos}}
                            </td>

                            <td class="px-4 py-2 truncate">
                                {{$person->naturalidade}}
                            </td>

                            <td class="px-4 py-2 truncate">
                                {{$person->bairro}}
                            </td>

                            <td class="px-4 py-2 truncate">
                                {{$person->escolaridade}}
                            </td>

                            <td class="px-4 py-2 whitespace-nowrap">
                                {{$person->created_at}}
                            </td>

                            <td class="px-4 py-2 whitespace-nowrap">
                                {{$person->updated_at}}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            @include('paginator', ['paginator' => $people])
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
</x-app-layout>

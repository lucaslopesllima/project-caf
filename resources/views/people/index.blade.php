<x-app-layout>
    <main class="w-full">
        <h2 class="text-2xl font-bold ms-10 mt-10 mb-4 ms-3">{{ $is_volunteer=='voluntario'  ? 'Voluntário':'Beneficiários' }}</h2>
        <a class="btn btn-primary ms-3 me-5" href="{{ route('pessoa.create',['tipo' => $is_volunteer=='voluntario'  ? 1:0 ]) }}">Cadastrar</a>
        <div class="flex row mt-5 justify-content-center items-center">
            <form action="{{ route('pessoa.index')}}" method="get" class="flex row justify-content-center items-center">
                <x-input-label for="namePerson" class="mt-3 ms-3 mb-3">
                    Nome:&nbsp;
                    <x-text-input minleght="3" type="text" name="namePerson" id="namePerson">
                    </x-text-input>
                </x-input-label>
                <x-input-label for="cpfPerson" class="mt-3 ms-3 mb-3">
                    CPF:&nbsp;
                    <x-text-input minleght="3" type="text" name="cpfPerson" id="cpfPerson"> 
                    </x-text-input>
                </x-input-label>
                <x-secondary-button type="submit" class="ms-5 max-h-[25px]">Filtrar</x-secondary-button>
            </form>
            <form action="{{ route('pessoa.index')}}" method="get" class="flex row justify-content-center items-center">
                <x-secondary-button type="submit" class="ms-5 max-h-[25px]">Limpar Filtro</x-secondary-button>
            </form>
        </div>
        <div class="overflow-auto mx-auto max-h-[700px]">
            <table class="table w-full text-left ">
                <thead>
                    <tr>
                        <th class="w-1/6 px-4 py-2">Nome</th>
                        <th class="w-1/12 px-4 py-2">Idade</th>
                        <th class="w-1/12 px-4 py-2">Filhos</th>
                        <th class="w-1/6 px-4 py-2">Naturalidade</th>
                        <th class="w-1/6 px-4 py-2">CPF</th>
                        <th class="w-1/6 px-4 py-2">Última atualização</th>
                        <th class="w-1/6 px-4 py-2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($people as $person)
                    <tr class="hover:bg-gray-900/50">
                        <td class="px-4 py-2 truncate">
                            {{ $person->nome }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $person->idade }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $person->quantidade_filhos }}
                        </td>
                        <td class="px-4 py-2 truncate">
                            {{$person->naturalidade}}
                        </td>
                        <td class="px-4 py-2 truncate">
                            {{ formattMask($person->cpf, '###.###.###-##') }}
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($person->updated_at)->format('d/m/Y') }}
                        </td>
                        <td>
                            <a href="{{ route('pessoa.edit',['pessoa'=>$person]) }}" class="btn btn-ghost btn-xs">Editar</a>
                            <form action="{{ route('pessoa.destroy', ['pessoa' => $person]) }}" method="POST" style="display:inline;">
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
            @include('paginator', ['paginator' => $people])
        </div>
    </main>
</x-app-layout>